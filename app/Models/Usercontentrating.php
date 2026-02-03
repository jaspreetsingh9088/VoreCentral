<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usercontentrating extends Model
{
    use HasFactory;
    protected $fillable = [
        'content_id',
        'user_id',
        'rating',
    ];
}
