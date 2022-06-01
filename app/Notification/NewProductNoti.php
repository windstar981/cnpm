<?php

namespace App\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

use function url;

class NewProductNoti extends Notification
{
    use Queueable;

    private $products;
    private $date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($products, $date)
    {
        //
        $this->products  = $products;
        $this->date  = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
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
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("[Junno]Thông tin các sản phẩm mới")
            ->view("notification.mail",
                [
                    'products'  => $this->products,
                    'date' => $this->date,
                ]);
    }

}
