<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Notification;
use App\Events\NewsCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsCreated $event): void
    {
        // Send notification when news is created
        $author = $event->news->author;

        Notification::create([
            'user_id' => $author->id,
            'data' => 'New article created: ' . $event->news->title,
            'read_at' => null,
        ]);
    }
}
