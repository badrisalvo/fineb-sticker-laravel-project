<?php

namespace App\Observers;
use App\Barang;
use App\Order;
use App\Statistik;
use App\Merek;

class LaporanPenjualanObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        // Mendapatkan bulan dan tahun dari tanggal pembayaran
        $bulan = $order->created_at->format('M');
        $tahun = $order->created_at->format('Y');
        $nama_barang = $this->namaBarang($order->barang_id);
        $barang_id = $barang->id;
        // Mencari data statistik berdasarkan bulan dan tahun
        $statistik = Statistik::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('barang_id', $barang_id)
            ->first();

        // Jika data statistik belum ada, buat data baru
        if (!$statistik) {
            $statistik = new Statistik([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'barang_id' => $barang_id,
                'nama_barang' => $nama_barang,
                'total_penjualan' => 1,
            ]);
        } else {
            // Jika data statistik sudah ada, tambahkan jumlah penjualan
            $statistik->total_penjualan += 1;
        }

        // Simpan data statistik
        $statistik->save();
    }
    public function namaBarang($id)
    {
        $barang = Barang::findorfail($id);
        $namaBarang = $barang->merek->name . ' ' . $barang->type;
        return $namaBarang;
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
