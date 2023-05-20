<?php

namespace App\Http\Livewire\App\Notification;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppMenuNotificationCard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        return view('livewire.app.notification.app-menu-notification-card',['notifications'=>$notifications]);
    }
}
