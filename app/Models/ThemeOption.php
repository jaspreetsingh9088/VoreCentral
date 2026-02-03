<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;
    protected $table = "theme_options";
    protected $fillable = [
        'user_id',
        'homepage_theme',
        'gallery_theme',
        'forums_theme',
        'others_theme',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];
}
