<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    protected $table = ['barang_id','nama_barang', 'jumlah_penjualan', 'bulan', 'tahun'];
}
