<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievementpoint extends Model
{
    use HasFactory;
    protected $table = "achievement_points";
    protected $fillable = [
        'user_id',
        'page',
        'point',
        'page_no'
    ];

    // content details  =>
    // thread           =>
    // thread detail    =>
    // dlc              =>
    // content promoted =>

}
