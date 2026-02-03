<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackUserVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creator_id',
        'link'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, "creator_id");
    }
}
