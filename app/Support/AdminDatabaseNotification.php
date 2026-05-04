<?php

namespace App\Support;

use App\Models\User;
use Filament\Notifications\Notification;

class AdminDatabaseNotification
{
    public static function send(string $title, string $body): void
    {
        $notification = Notification::make()
            ->title($title)
            ->body($body)
            ->success()
            ->toDatabase();

        User::query()
            ->where('role', 'admin')
            ->each(fn (User $user) => $user->notifyNow($notification));
    }
}
