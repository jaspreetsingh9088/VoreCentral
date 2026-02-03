<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class Thread extends Model
{
    use HasFactory;

     protected $fillable = [
        'topic',
        'comment',
        'media',
        'cid',
        'userid',
        'thread_lock'
    ];


    public function getMediaAttribute($value){        
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('thread/'.$value))) {
                return asset('thread/'.$value);
            }else{
                return asset('default.png');
            }
        }
    }

    public function user(){
        return $this->belongsTo(User::class,'userid');
    }
}
