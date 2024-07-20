<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'barang_id'];

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }

    protected $table = 'favorite';
}
