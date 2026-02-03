<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Creator extends Model
{
    use HasFactory;

    protected $fillable = [
        'paypal',
        'content_type',
        'old_account',
        'content_description',
        'subgenres',
        'userid',
        'created_at',
        'updated_at',
    ];


    public function getUseridAttribute($value)
    {

        if ($value > 0) {
            return $this->attributes['username'] = User::find($value);
        } else {
            return null;
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }


}
