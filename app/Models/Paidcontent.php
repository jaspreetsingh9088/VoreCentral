<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Paidcontent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'price',
        'description',
        'title',
        'content',
        'thumbnail',
        'tag_id',
        'status',
        'type',
        'is_delete',
        'content_type',
        'other_files',
        'other_thumbnails'
    ];

    public function getThumbnailAttribute($value)
    {
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('thumbnail/'.$value))) {
                return asset('thumbnail/'.$value);
            }else{
                return asset('default.png');
            }
        }
        // return  $this->attributes['thumbnail'] = asset('thumbnail/'.$value??'defaultcover.jpg');
    }
    public function getContentAttribute($value)
    {
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('content/'.$value))) {
                return asset('content/'.$value);
            }else{
                return asset('default.png');
            }
        }
        // return  $this->attributes['content'] = asset('content/'.$value??'defaultprofilepic.jpg');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'id');
    }
}
