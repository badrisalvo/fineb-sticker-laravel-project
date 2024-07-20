<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Merek;
use App\Order; 
use App\Bukti;
use App\Barang;
use App\Statistik;
use App\PDF;
use App\SalesController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Notifications\PaymentSuccessful;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::where('payment_status', 'Sudah Dibayar')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $salesData = Order::selectRaw('barang.merek_id, SUM(order.quantity) as total_quantity')
            ->join('barang', 'order.barang_id', '=', 'barang.id')
            ->where('order.payment_status', 'Sudah Dibayar')
            ->groupBy('barang.merek_id')
            ->get();

        return view('admin.order.index', compact('order', 'salesData'));
    }




   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findorfail($id);
        $user = User::findorfail($order->user_id);
        return view('admin.order.show', compact('order', 'user'));
    }
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tampil_pending()
    {
        $order = Order::where('payment_status', 'Dipending')->paginate(10);
        return view('admin.order.tampil_pending', compact('order','user'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // ... kode lainnya ...

        // Proses pembayaran selesai
        $order_data = [
            'payment_status' => 'Sudah Dibayar',
        ];
        $order->update($order_data);

        // Kirim notifikasi ke pengguna
        $user = $order->user;
        $user->notify(new PaymentSuccessful($order));
        // $this->updateStatistik($order);
        return redirect()->route('order.index')->with('success', 'Order Berhasil Dikonfirmasi');
    }
    public function cetakBuktiPembayaran($id)
{
    $order = Order::findOrFail($id);
    $user = User::findOrFail($order->user_id);

    return view('user.cetak', compact('order', 'user'));
}

    public function namaBarang($id)
    {
        $barang = Barang::findOrFail($id);
        $namaBarang = $barang->merek->name . ' ' . $barang->type;
        return $namaBarang;
    }
    private function updateStatistik($order)
    {
        // Mendapatkan bulan dan tahun dari tanggal pembayaran
        $bulan = $order->created_at->format('M');
        $tahun = $order->created_at->format('Y');

        // Mendapatkan nama barang berdasarkan ID barang
        $nama_barang = $this->namaBarang($order->barang_id);

        // Inisialisasi variabel $statistik dengan nilai null
        $statistik = null;

        // Mencari data statistik berdasarkan bulan, tahun, ID barang, dan nama barang
        $statistik = Statistik::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('nama_barang', $nama_barang)
            ->where('barang_id', $order->barang_id)
            ->first();

        // Jika data statistik belum ada, buat data baru
        if (!$statistik) {
            $statistik = new Statistik([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'barang_id' => $order->barang_id,
                'nama_barang' => $nama_barang,
                'jumlah_penjualan' => 1,
            ]);
        } else {
            // Jika data statistik sudah ada, tambahkan jumlah penjualan
            $statistik->jumlah_penjualan += 1;
        }

        // Simpan data statistik
        $statistik->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findorfail($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Periksa status pemesanan, pastikan hanya pemesanan yang belum dibayar atau sedang dalam proses pembayaran yang dapat dibatalkan
        if ($order->payment_status === 'Belum Dibayar' || $order->payment_status === 'Dipending') {
            // Kembalikan stok barang
            $barang = Barang::find($order->barang_id);
            if ($barang) {
                $barang->stock += $order->quantity;
                $barang->save();
            } else {
                return redirect()->back()->with('error', 'Barang tidak ditemukan.');
            }

            // Ubah status pemesanan menjadi "Dicancel"
            $order->payment_status = 'Dicancel';
            $order->save();

            // Hapus pemesanan dari database
            // $order->delete();

            return redirect()->back()->with('success', 'Pemesanan berhasil dibatalkan, stok barang dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Pemesanan tidak dapat dibatalkan karena sudah dalam proses pembayaran atau sudah dibayar.');
        }
    }
    public function tampil_cancel()
    {
        $order = Order::where('payment_status', 'Dicancel')->paginate(10);
        return view('admin.order.tampil_cancel', compact('order','user'));
    }

    public function history()
    {
        $user = User::findorfail(Auth::user()->id);
        $order = Order::orderBy('created_at', 'DESC')->where('user_id', $user->id)->paginate(10);
        $merek = Merek::all();

        return view('user.history', compact('order', 'merek'));
    }

    public function pembayaran($id)
    {
        $order = Order::findorfail($id);
        $merek = Merek::all();

        return view('user.pembayaran', compact('order', 'merek'));
    }
    public function searchOrder(Request $request)
    {
        $order_id = $request->input('order_id');

            // Lakukan pencarian order berdasarkan ID di database
            $order = Order::find($order_id);

            // Jika order ditemukan, tampilkan data order tersebut
            if ($order) {
                return view('order_detail', compact('order'));
            } else {
                // Jika order tidak ditemukan, berikan pesan bahwa order tidak ditemukan
                return redirect()->route('order.index')->with('error', 'Order not found.');
            }
        }


    public function proses_pembayaran(Request $request, $id)
    {
        $this->validate($request, [
            'nama_bank' => 'required',
            'nama_pengirim' => 'required',
          ]);

        $order = Order::findorfail($id);

        $order_data = [
            'payment_status' => 'Dipending',
        ];

        $order->update($order_data);
        $gambar = $request->gambar;
        $foto = date('Ymdhis') . "_" . $gambar->getClientOriginalName();
        Bukti::create([
            'order_id' => $id,
            'foto' => 'uploads/bukti/' . $foto,
            'nama_bank' => $request->nama_bank,
            'nama_pengirim' => $request->nama_pengirim,
        ]);
        $gambar->move('uploads/bukti/', $foto);

        return redirect()->route('pembayaran.success')->with('success', 'Pembelian Berhasil Silahkan Melakukan Pembayaran Melalui Payment Yang Anda Pilih');
    }

    public function success()
    {
        $merek = Merek::all();

        return view('user.success', compact('merek'));
    }

    // public function cari ($id)
    // {
    //     $order = Order::findorfail($id);
    //     return view('admin.order.tampil_pending', compact('order'));
    // }
 
}
