<?php

namespace App\Traits;

use App\Models\Notificationlog;
use App\Models\Tagoption;
use App\Models\TrackUserVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait Notification
{
    public function NotificationInsert($sender_id, $receiver_id, $content_id, $notification_type, $message, $type, $status)
    {
        $notification = Notificationlog::insert([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'content_id' => $content_id,
            'notification_type' => "$notification_type",
            'message' => $message,
            'type' => $type,
            'status' => "$status"
        ]);

        // Removing Notification Items From The Cache
        Cache::forget('notification_' . Auth::id());
        Cache::forget('unread_notification_' . Auth::id());
        Cache::forget('my_notification_' . Auth::id());

        return $notification;
        /*
            =========NOTIFICATION TYPE
            Defualt => undefind
            ----- USER CONTENT
            Someone likes my item => like *
            Someone dislikes my item => dislike *
            Someone comments on my item     => comment *
            New item with more than 75% of my tags is uploaded  => item match

            Subscribee uploads  => Subscription upload *
            Subscribe uploads to the webstore   => Subscribe upload webstore *

            ----- USER PAGE
            Comments on my userpage => comment on userpage *
            Status updates from users I follow  => follow *
            Comments and likes on my userpage comments => comment reacts on userpage *

            New DLC from creators I follow  => DLC creators follow *
            Somebody downloads my DLC   => DLC download *
            Somebody reacts to my DLC   => DLC reacts *

            Userquotes my message   => quotes message *
            User @mentions me   => mentions *
            Post in thread I've posted in   => posted thread *
            Post in thread I follow => post thread I follow *
            Post in thread I've started => post thread started *
            User likes my post  => thread like *

            ========= TYPE
            Gallery Notifications   => usercontent
            Subscriptions Notifications => subscription
            Notifications Userpage  => userpage
            Notifications DLC   => DLC
            Notifications forums    => forums
        */
    }

    public function Tagmatch($tag, $content_id)
    {

        $matchtaguser = new Tagoption();
        $str = '';
        $i = 1; // to append AND in query

        foreach ($tag as $key => $value) {
            $str .= 'FIND_IN_SET("' . $value . '" ,fac)';
            if ($i < count($data)) {
                $str .= ' AND '; // use OR as per use
            }
            $i++;
        }
        // whereRaw("find_in_set('".$search_id."',posts.tag_id)")->get();
        dd($tag);
    }

    public function visitCount($user_id, $creator_id, $link)
    {
        if (isset($user_id, $creator_id) && $user_id != $creator_id) {
            TrackUserVisit::create([
                "user_id" => $user_id,
                "creator_id" => $creator_id,
                "link" => $link
            ]);
        }
    }
}
