<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallaryNotification extends Model
{
    use HasFactory;
    protected $table = "gallary_notifications";
    protected $fillable = [
        'user_id',
        'receiver_id',
        'likes',
        'like_oncomment',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];
}
