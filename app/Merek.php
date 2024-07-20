<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    protected $fillable = ['name'];

    public function jumlah($id)
    {
        $barang = Barang::where('merek_id', $id)->count();
        return $barang;
    }

    protected $table = 'merek';
}
