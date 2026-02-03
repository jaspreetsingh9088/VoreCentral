<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;
class Threadcomment extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'comment',
        'media',
        'userid',
        'threadid',
        'parent_id',
    ];
    protected $append = [
        'image_url',
    ];

    public function user(){
        return $this->belongsTo(User::class,'userid');
    }

    public function getImageUrlAttribute()
    {
        if(!isset($this->media)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('threadcomment/'.$this->media))) {
                return asset('threadcomment/'.$this->media);
            }else{
                return asset('default.png');
            }
        }
    }

    public function getMediaAttribute($value){ 
        if(!is_null($value)){
            if(!isset($value)){
                return asset('default.png');
            }else{
                if (File::exists(public_path('threadcomment/'.$value))) {
                    return asset('threadcomment/'.$value);
                }else{
                    return asset('default.png');
                }
            }
        }
    }
}
