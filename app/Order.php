<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
  use SoftDeletes;

  protected $fillable = ['user_id', 'barang_id', 'quantity','stock', 'total', 'payment_status'];

  public function barang()
  {
    return $this->belongsTo('App\Barang');
  }

  public function namaBarang($id)
  {
    $barang = Barang::findorfail($id);
    $namaBarang = $barang->merek->name;
    return $namaBarang;
  }

  public function tipeBarang($id)
  {
    $barang = Barang::findorfail($id);
    $tipeBarang = $barang->type;
    return $tipeBarang;
  }

  public function hargaBarang($id)
  {
    $barang = Barang::findorfail($id);
    $hargaBarang = $barang->price;
    return $hargaBarang;
  }
  // public function stockBarang($id)
  // {
  //   $barang = Barang::findorfail($id);
  //   $stockBarang = $barang->stock;
  //   return $stockBarang;
  // }

  public function bukti($id)
  {
    $bukti = Bukti::where('order_id', $id)->first();
    return $bukti;
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
  protected $table = 'order';
}
