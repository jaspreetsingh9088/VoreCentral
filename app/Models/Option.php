<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = "options";
    protected $fillable = [
        'user_id',
        'preffered_font',
        'timezone',
        'change_email',
        'show_comments',
        'creator_pages_custom_theme	',
        'webstore_level',
        'general_privacy',
        'gender	',
        'sexual_orientation',
        'vore_role_preference',
        'cursor_style',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];

}
