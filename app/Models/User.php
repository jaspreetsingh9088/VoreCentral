<?php

namespace App\Models;

use App\Models\Paidcontent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use File;

class User extends Authenticatable
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
        'username',
        'email',
        'gender',
        'sexual_orientation',
        'role_preference',
        'password',
        'dob',
        'status',
        'ip_address',
        'latitude',
        'longitude',
        'remember_token',
        'creator',
        'points',
        'profile_pic',
        'customer_id',
        'stripe_acc',
        'achievements',
        'prey_achievements',
        'creator_id',
        'stripe_account_link',
        'stripe_link_expires_at',
        "stripe_status",
        "moderator"
    ];
    protected $append = [
        'dashboard_link'
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

    public function getDashboardLinkAttribute()
    {

        if ($this->creator == 1) {
            return route('creatorvisitordashboard', [$this->id]);
        } else {
            return route('profiledashboard', [$this->id]);
        }
        return 'javascript:;';
    }

    public function getProfilePicAttribute($value)
    {
        if (!isset($value)) {
            return asset('profilepic/defaultprofilepic.jpg');
        } else {
            if (File::exists(public_path('profilepic/' . $value))) {
                return asset('profilepic/' . $value);
            } else {
                return asset('profilepic/defaultprofilepic.jpg');
            }
        }
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lastlogin()
    {
        return $this->hasMany(Loginactivity::class, 'user_id');
    }

    public function paidcontent()
    {
        return $this->hasMany(Paidcontent::class, 'user_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class, 'sender_id', 'receiver_id');
    }

    public function setPasswordAttribute($password)
    {

        $this->attributes['password'] = Hash::make($password);
    }

    // public function getProfilePicAttribute($value){
    //     if($value == null){
    //         return asset('profilepic/defaultprofilepic.jpg');
    //     }else{
    //         return asset('profilepic/'.$value);
    //     }
    // }

    public function getCoverPicAttribute($value)
    {

        if ($value == null) {
            return $this->attributes['cover_pic'] = asset('coverpic/defaultcover.jpg');
        } else {
            return $this->attributes['cover_pic'] = asset('coverpic/' . $value);
        }
    }

    public function getThemebgAttribute($value)
    {

        if ($value == null) {
            // return $this->attributes['themebg'] = asset('assets/images/green_bg.webp');
            return asset('assets/images/green_bg.webp');
        } else {
            return asset('themebg/' . $value);
        }
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'email', 'email');
    }


}
