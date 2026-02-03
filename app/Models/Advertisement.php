<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $table = "advertisements";
    protected $fillable = [
        'name',
        'content1',
        'content2',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];

    public function getImage1Attribute($value)
    {
        return  $this->attributes['image1'] = asset('image1/'.$value??'defaultprofilepic.jpg');
    }

    public function getImage2Attribute($value)
    {
        return  $this->attributes['image2'] = asset('image2/'.$value??'defaultcover.jpg');
    }
}
