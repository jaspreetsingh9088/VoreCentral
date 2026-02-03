<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPrivacyOption extends Model
{
    use HasFactory;
    protected $table = "notification_privacy_options";
    protected $fillable = [
        'user_id',
        'profileview_access',
        'gallary_notification',
        'activity',
        'subscription',
        'post_access',
        'general_privacy',
        'radio_group',
        'notification_userpage',
        'notification_forum',
        'notification_dlc',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];
}
