<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAccountCreatedNotifyAdmins extends Notification implements ShouldQueue
{
    use Queueable;
    private $entity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', \App\Notifications\CustomDbChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(config('app.name') . ' - New Account Registration')
            ->greeting('Dear ' . $notifiable['name'] . ',')
            ->line('A new account has been registered with email: "' . $this->entity['email'] . '" and name: "' . $this->entity['name'] . '". You are advised to review this account.')
            ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->entity->id,
            'data' => $this->entity,
            'category' => 'New Account Registration',
        ];
    }

}
