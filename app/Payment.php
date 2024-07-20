<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PaymentSuccessful;

class Payment extends Model
{
    use Notifiable;

    // ...


    protected $fillable = ['payment_status'];

    public function markAsComplete()
    {
        $this->status = 'complete';
        $this->save();
        $this->notify(new \App\Notifications\PaymentSuccessful());
    }
}