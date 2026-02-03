<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Searchsorting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gallery_searche',
        'forum_searche',
        'webstore_searche',
        'gs_nonevore',
        'gs_nonevore'
    ];
}
