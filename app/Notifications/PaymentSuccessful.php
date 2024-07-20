<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessful extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;

        return (new MailMessage)
        ->subject('Pembayaran Dikonfirmasi')
        ->greeting('Halo, ' . $notifiable->name)
        ->markdown('mail.notification', ['user' => $notifiable, 'order' => $this->order]);
        // ->line('Pembayaran Anda telah dikonfirmasi.')
        // ->line('Berikut adalah detail pesanan:')
        // ->line('Nama Barang: ' . $order->namaBarang($order->barang_id))
        // ->line('Jumlah: ' . $order->quantity )
        // ->line('Total: Rp. ' . number_format($order->total, 0))
        // ->line('Terima kasih telah menggunakan layanan kami.')
        // ->line('Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
