<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_pesanan;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_pesanan)
    {
        $this->data_pesanan = $data_pesanan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data_pesanan['subject'])
            ->from($this->data_pesanan['sender_name'])
            ->view('mail.KirimEmail');
    }
}
