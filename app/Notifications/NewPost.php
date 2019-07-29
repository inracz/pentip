<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;

class NewPost extends Notification
{
    use Queueable;

    private $post;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'type' => 'newpost',
            'id' => $this->post->id,
            'title' => $this->post->title,
            'author' => [
                'id' => $this->post->user->id,
                'name' => $this->post->user->name,
            ]
        ];
    }
}
