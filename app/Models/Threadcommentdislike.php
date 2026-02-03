<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threadcommentdislike extends Model
{
    use HasFactory;
    protected $table = "threadcomment_dislikes";
    protected $fillable = [
        'user_id',
        'comment_id',

    ];
}
