<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $fillable = [
        'subject',
        'message',
        'sender_id',
        'receiver_id',
        'is_draft',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];

    /**
     * Get the user who sent this message
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function sender() {
        return $this->hasOne(User::class, 'id','sender_id');
    }
    public function profile() {
        return $this->hasOne(User::class, 'profile_pic','sender_id');
    }

    /**
     * Get the user who received this message
     */
    public function receiver() {
        return $this->hasOne(User::class, 'id','receiver_id');
    }

    /**
     * Get the chat
     */
    
}
