<?php

namespace App\Http\Controllers;

use Auth;
use App\Barang;
use App\Merek;
use App\Order;
use App\Favorite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Illuminate\Validation\ValidationException;

class BarangController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $barang = Barang::paginate(10);
    return view('admin.barang.index', compact('barang'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $merek = Merek::all();
    return view('admin.barang.create', compact('merek'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'type' => 'required',
      'price' => 'required',
      'gambar' => 'required',
      'stock' => 'required'
    ]);

    $gambar = $request->gambar;
    $new_gambar = date('Ymdhis') . "_" . $gambar->getClientOriginalName();

    Barang::create([
      'merek_id' => $request->merek_id,
      'type' => $request->type,
      'price' => $request->price,
      'gambar' => 'uploads/barang/' . $new_gambar,
      'stock' => $request->stock,
    ]);

    $gambar->move('uploads/barang/', $new_gambar);

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Disimpan');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $barang = Barang::findorfail($id);
    $merek = Merek::all();
    $produk = Barang::where('merek_id', $barang->merek_id)->orderBy('created_at', 'DESC')->limit(5)->get();
    return view('user.show', compact('barang', 'merek', 'produk'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $barang = Barang::findorfail($id);
    $merek = Merek::all();
    return view('admin.barang.edit', compact('barang', 'merek'));
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
    $this->validate($request, [
      'price' => 'required',
      'type' => 'required',
      'stock' => 'required'
    ]);

    $barang = Barang::findorfail($id);

    if ($request->gambar == true) {
      $gambar = $request->gambar;
      $new_gambar = date('Ymdhis') . "_" . $gambar->getClientOriginalName();
      $gambar->move('uploads/barang/', $new_gambar);
      $barang_data = [
        'merek_id' => $request->merek_id,
        'type' => $request->type,
        'price' => $request->price,
        'gambar' => 'uploads/barang/' . $new_gambar,
        'stock' => $request->stock,
      ];
    } else {
      $barang_data = [
        'merek_id' => $request->merek_id,
        'price' => $request->price,
        'type' => $request->type,
        'stock' => $request->stock,
      ];
    }

    $barang->update($barang_data);

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $barang = Barang::findorfail($id);
    $barang->delete();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Dihapus (Silahkan cek trashed barang)');
  }

  public function new()
  {
    $barang = Barang::paginate(10);
    $merek = Merek::all();
    return view('admin.barang.index', compact('barang', 'merek'));
  }

  public function tampil_hapus()
  {
    $barang = Barang::onlyTrashed()->paginate(10);
    return view('admin.barang.tampil_hapus', compact('barang'));
  }

  public function restore($id)
  {
    $barang = Barang::withTrashed()->where('id', $id)->first();
    $barang->restore();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Direstore (Silahkan cek list barang)');
  }

  public function kill($id)
  {
    $barang = Barang::withTrashed()->where('id', $id)->first();
    $barang->forceDelete();

    return redirect()->back()->with('success', 'Postingan Anda Berhasil Dihapus Secara Permanent');
  }

  public function home()
  {
    $barang = Barang::orderBy('created_at', 'DESC')->get();
    $car = Barang::orderBy('created_at', 'DESC')->limit(5)->get();
    $merek = Merek::all();
    return view('user.index', compact('barang', 'car', 'merek'));
  }

  public function cart()
  {
    $cart = session()->get('cart');
    $barang = Barang::paginate(10);

    $this->item['chart'] = $cart;
    $this->item['barang'] = $barang;

    $merek = Merek::all();
    $produk = Barang::orderBy('created_at', 'DESC')->limit(4)->get();

    return view('user.cart', compact('merek', 'produk'));
  }

  public function addToCart($id)
  {
      $barang = Barang::findorfail($id);
  
      if (!$barang) {
          abort(404);
      }
  
      $cart = session()->get('cart', []);
  
      if (isset($cart[$id])) {
          // Pastikan tidak melebihi stok barang yang tersedia
          if ($cart[$id]['quantity'] >= $barang->stock) {
              return redirect()->back()->with('error', 'Stok barang sudah habis.');
          }
  
          $cart[$id]['quantity']++;
          session()->put('cart', $cart);
          return redirect()->back()->with('success', 'Product added to cart successfully!');
      }
  
      // Pastikan stok barang tersedia sebelum menambahkan ke keranjang
      if ($barang->stock <= 0) {
          return redirect()->back()->with('error', 'Stok barang sudah habis.');
      }
  
      $cart[$id] = [
          "barang_id" => $barang->id,
          "name" => $barang->type,
          "brand" => $barang->merek->name,
          "quantity" => 1,
          "price" => $barang->price,
          "photo" => $barang->gambar,
      ];
  
      session()->put('cart', $cart);
      return redirect()->route('cekout')->with('success', 'Barang ditambahkan ke keranjang. Lanjutkan ke pembayaran.');
  }

  public function update_cart(Request $request)
  {
    // if ($request->id && $request->quantity) {
    //   $cart = session()->get('cart');
    //   $cart[$request->id]['quantity'] = $request->quantity;
    //   session()->put('cart', $cart);
    //   session()->flash('success', 'Cart updated successfully!');
    // }
    if ($request->id && $request->quantity) {
      // Ambil data barang dari database berdasarkan ID
      $barang = Barang::find($request->id);

      if ($barang && isset($barang->stock)) { 

          if ($request->quantity > $barang->stock) {
              return redirect()->back()->with('error', 'Jumlah barang melebihi stok yang tersedia.');
          }
          $cart = session()->get('cart');
          $cart[$request->id]['quantity'] = $request->quantity;
          session()->put('cart', $cart);
          session()->flash('success', 'Cart updated successfully!');
      } else {
          return redirect()->back()->with('error', 'Barang tidak valid.');
      }
  }
  }

  public function remove(Request $request)
  {
    if ($request->id) {
      $cart = session()->get('cart');

      if (isset($cart[$request->id])) {
        unset($cart[$request->id]);

        session()->put('cart', $cart);
        Session::flash('success', 'Berhasil menghapus product');
      }
    }
  }

  public function cekout()
  {
    $cart = session()->get('cart');
    $barang = Barang::paginate(10);

    $this->item['chart'] = $cart;
    $this->item['barang'] = $barang;

    $merek = Merek::all();

    return view('user.cekout', compact('merek'));
  }

  public function proses_cekout(Request $request, $id)
  {
    $this->validate($request, [
      'name' => 'required',
      'address' => 'required',
      'kelurahan' => 'required',
      'kabupaten' => 'required',
      'kecamatan' => 'required',
      'provinsi' => 'required',
      'email' => 'required',
      'kode_pos' => 'required|max:5',
      'telepon' => 'required|min:10|max:13',
    ]);

    $user = User::findorfail($id);

    $user_data = [
      'address' => $request->address,
      'kelurahan' => $request->kelurahan,
      'kabupaten' => $request->kabupaten,
      'kecamatan' => $request->kecamatan,
      'provinsi' => $request->provinsi,
      'kode_pos' => $request->kode_pos,
      'telepon' => $request->telepon,
    ];

    $user->update($user_data);

    $cart = session()->get('cart');

    foreach ($cart as $details) {
      $barang = Barang::find($details['barang_id']);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Periksa apakah stok barang cukup
        if ($barang->stock >= $details['quantity']) {
            // Kurangi stok barang
            $barang->stock -= $details['quantity'];
            $barang->save();
        } else {
            return redirect()->back()->with('error', 'Maaf, stok barang tidak mencukupi.');
        }
      Order::create([
        'user_id' => $id,
        'barang_id' => $details['barang_id'],
        'quantity' => $details['quantity'],
        'total' => $details['price'] * $details['quantity'],
        'payment_status' => 'Belum Dibayar',
      ]);
    }

    $request->session()->forget('cart');

    $order = Order::orderBy('created_at', 'DESC')->where('user_id', $id)->first();

    return redirect()->route('pembayaran', $order->id)->with('success', 'Pembelian Berhasil Silahkan Melakukan Pembayaran Melalui Payment Yang Anda Pilih');
  }

  public function category($id)
  {
    $judul = Merek::findorfail($id);
    $barang = Barang::orderBy('created_at', 'DESC')->where('merek_id', $id)->paginate(12);
    $new = Barang::orderBy('created_at', 'DESC')->first();
    $merek = Merek::all();

    return view('user.category', compact('judul', 'barang', 'new', 'merek'));
  }

  public function like($id)
  {
    Favorite::create([
      'user_id' => Auth::user()->id,
      'barang_id' => $id,
    ]);

    return redirect()->back()->with('success', 'Product added to favorite successfully!');
  }

  public function unlike($id)
  {
    $like = Favorite::where('user_id', Auth::user()->id)->where('barang_id', $id)->first();
    $like->delete();

    return redirect()->back()->with('success', 'Product cancel to favorite successfully!');
  }

  public function favorite()
  {
    $like = Favorite::where('user_id', Auth::user()->id)->get();
    $new = Barang::orderBy('created_at', 'DESC')->first();
    $merek = Merek::all();

    return view('user.favorite', compact('like', 'new', 'merek'));
  }


}