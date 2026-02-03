<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Creatorcontent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $searchable = [
        'username',
        'email',
    ];

    protected $fillable = [
     
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    
    public function getContentAttribute($value){
        
            if($value == null){
            return  $this->attributes['content'] = asset('creatorcontent/defaultprofilepic.jpg') ;
            }else{
            return  $this->attributes['content'] = asset('creatorcontent/'.$value) ;
            }
        }
        
        
        public function getThumbnailAttribute($value){
        
            if($value == null){
             return  $this->attributes['thumbnail'] = asset('creatorthumbnail/defaultcover.jpg') ;
            }else{
            return  $this->attributes['thumbnail'] = asset('creatorthumbnail/'.$value) ;
            }
        }    
    
    
}
