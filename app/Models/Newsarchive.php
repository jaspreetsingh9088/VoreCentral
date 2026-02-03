<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Newsarchive extends Model
{
    use HasFactory;
    protected $table = "news_archieves";
    protected $fillable = [
        'image',
        'title',
        'description',
        'status'
    ];
    protected $append = [
        'image_url',
    ];
    public function getImageAttribute($value)
    {
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('newsarchive/'.$value))) {
                return asset('newsarchive/'.$value);
            }else{
                return asset('default.png');
            }
        }
        // return  $this->attributes['image'] = url('/newsarchive/'.$value??'defaultprofilepic.jpg');
    }
    public function getImageUrlAttribute()
    {
        if(!isset($this->image)){
            return null;
        }
        return asset('public/newsarchive/'.$this->image);
    }
}
