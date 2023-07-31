<?php

namespace Modules\Message\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactMessageNofifyAdmin extends Notification implements ShouldQueue
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
            ->subject(config('app.name') . ' - ' . $this->entity['name'] . '\'s new contact message')
            ->greeting('Dear ' . $notifiable['name'] . ',')
            ->line('New contact message details')
            ->line('Name: ' . $this->entity['name'])
            ->line('Email: ' . $this->entity['name'])
            ->line('Phone: ' . $this->entity['name'])
            ->line('Message: ' . $this->entity['message'])
            ->action('Read message', $this->entity->entity_links['url'])
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
            'category' => 'Contact Message',
        ];
    }
}
