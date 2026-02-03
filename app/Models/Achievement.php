<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = "achievement";
    protected $fillable = [
        'name',
        'images',
        'type',
        'status'
    ];
    public function getImagesAttribute($value)
    {
        return  $this->attributes['images'] = url('/public/achievement/profile/'.$value??'defaultprofilepic.jpg');
    }
}
