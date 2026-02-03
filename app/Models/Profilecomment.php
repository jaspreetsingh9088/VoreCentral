<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profilecomment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'uid',
        'postid',
    ];
}
