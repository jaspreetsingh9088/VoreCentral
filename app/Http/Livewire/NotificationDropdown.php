<?php

namespace App\Http\Livewire;

use App\Models\Notificationlog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NotificationDropdown extends Component
{
    public function render()
    {
        $cache_time = config('cache.time');

        $notification = Notificationlog::where('receiver_id', Auth::id())->with('sender')->limit(10)->orderBy('id', 'DESC')->get();

        $unread =  Notificationlog::where('receiver_id', Auth::id())->where('status', '0')->count();
        return view('livewire.notification-dropdown',compact('notification','unread'));
    }
}
