<?php

namespace App\Http\Controllers\Front;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notificationlog;
use App\Models\Option;
use App\Models\NotificationPrivacyOption;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public $cache_time;
    public function __construct()
    {
        // Cache Time
        $this->cache_time = config('cache.time');
    }
    public function updateStatus(){
        Notificationlog::where('receiver_id', Auth::id())->update(['status'=>'1']);
        return response()->json(['status' => '200']);
    }
    public function index(){
        $font = Option::where('user_id', Auth::id())->value('preffered_font');

        $theme =  $this->themes('others_theme','red_theme');

        // $notification = Notificationlog::where('receiver_id',Auth::id())->with(['sender'])->orderBy('id','DESC')->get();
        $notification = Cache::remember('my_notification_' . Auth::id(), $this->cache_time, function () {
            return Notificationlog::where('receiver_id', Auth::id())->with(['sender'])->orderBy('id', 'DESC')->get();
        });


        return view('front.other_page.notification',compact('theme','notification','font'));
    }


}
