<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificationlog extends Model
{
    use HasFactory;
    protected $table = "notification_logs";
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content_id',
        'notification_type',
        'notification_section',
        'message',
        'type',
        'status',

    ];

    /*
        =========NOTIFICATION TYPE
        Defualt => undefind
        Someone likes my item => like
        Someone dislikes my item => dislike
        Someone comments on my item     => comment
        New item with more than 75% of my tags is uploaded  => item match
        Subscribee uploads  => Subscription upload
        Subscribe uploads to the webstore   => Subscribe upload webstore
        Comments on my userpage => comment on userpage
        Status updates from users I follow  => follow
        Comments and likes on my userpage comments => comment reacts on userpage
        New DLC from creators I follow  => DLC creators follow
        Somebody downloads my DLC   => DLC download
        Somebody reacts to my DLC   => DLC reacts
        Userquotes my message   => quotes message
        User @mentions me   => mentions
        Post in thread I've posted in   => posted in thread
        Post in thread I follow => post in thread I follow
        Post in thread I've started => post thread started
        User likes my post  => thread like

        ========= TYPE
        Gallery Notifications   => usercontent
        Subscriptions Notifications => subscription
        Notifications Userpage  => userpage
        Notifications DLC   => DLC
        Notifications forums    => forums
    */

    public function dlccontent()
    {
        return $this->belongsTo(Dlccontents::class, 'content_id');
    }

    public function content()
    {
        return $this->belongsTo(Usercontent::class, 'content_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


}
