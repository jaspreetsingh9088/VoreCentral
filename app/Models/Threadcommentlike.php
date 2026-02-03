<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threadcommentlike extends Model
{
    use HasFactory;
    protected $table = "threadcomment_likes";
    protected $fillable = [
        'user_id',
        'comment_id',

    ];
}
