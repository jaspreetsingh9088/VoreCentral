<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paidcontentrating extends Model
{
    use HasFactory;
    protected $table = "paidcontent_ratings";
    protected $fillable = [
        'content_id',
        'user_id',
        'rating',
    ];
}
