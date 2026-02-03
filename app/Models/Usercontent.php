<?php

namespace App\Models;
use App\Models\Tag;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usercontent extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

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
        'title',
        'description',
        'tags',
        'series',
        'type',
        'category',
        'content',
        'thumbnail',
        'video_url',
        'monetise',
        'userid',
        'is_featured',
        'promoted',
        'content_type'
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

    public function getThumbnailAttribute($value)
    {
        if(!isset($value)){
            return asset('default.png');
        }else{
            if (File::exists(public_path('thumbnail/'.$value))) {
                return asset('thumbnail/'.$value);
            }
            else if (File::exists(public_path('assets/images/'.$value))) {
                return asset('assets/images/'.$value);
            }
            else if (File::exists(public_path('content/'.$value))) {
                return asset('content/'.$value);
            }
            else{
                return asset('default.png');
            }
        }
        // return  $this->attributes['thumbnail'] = asset('thumbnail/'.$value??'defaultcover.jpg');
    }

    public function getRelevancyAttribute()
    {
        $yarray = collect([
            collect([
                "start" => 0,
                "end" => 1*24,
                "value" => 42,
            ]),collect([
                "start" => 1*24+1,
                "end" => 3*24,
                "value" => 8.25,
            ]),collect([
                "start" => 3*24+1,
                "end" => 5*24,
                "value" => 5.65,
            ]),collect([
                "start" => 5*24+1,
                "end" => 8*24,
                "value" => 3.33,
            ]),collect([
                "start" => 8*24+1,
                "end" => 11*24,
                "value" => 2.8,
            ]),collect([
                "start" => 11*24+1,
                "end" => 15*24,
                "value" => 2.5,
            ]),collect([
                "start" => 15*24+1,
                "end" => 24*24,
                "value" => 2,
            ]),collect([
                "start" => 24*24+1,
                "end" => 40*24,
                "value" => 1.78,
            ]),collect([
                "start" => 40*24+1,
                "end" => 60*24,
                "value" => 1.37,
            ]),collect([
                "start" => 60*24+1,
                "end" => 90*24,
                "value" => 1.28,
            ]),collect([
                "start" => 90*24+1,
                "end" => 180*24,
                "value" => 1.07,
            ]),collect([
                "start" => 180*24+1,
                "end" => 360*24,
                "value" => 1,
            ])
        ]);
        $viewscount = Cache::remember('view-'.$this->id, 60*3, function () {
            return $this->views()->count();
        });
        $usertages = Cache::remember('usertag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->count();
        });
        $matchtages = Cache::remember($this->id.'-contenttag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->whereIn('tagid', explode(",", $this->tag))->count();
        });
        $diffrenece = $this->created_at->diff(now());
        $diffrenecehours = $diffrenece->h+$diffrenece->d*24;
        $lastyele = $yarray->sortBy([['end', 'desc']])->first();
        if ($lastyele['end'] >= $diffrenecehours) {
            $yele = $yarray->where('start', '<=', $diffrenecehours)->where('end', '>=', $diffrenecehours)->first();
        } else {
            $yele = $lastyele;
        }
        $y = $yele['value'];
        // X = log(100+200) * 0.7^(1+0.15*42(-0.015*5(+0.0092))
        // X = log(100+views) * 0.7^(1+0.15*recency(-0.015*numberofmatchedtags(+0.0092))
        $x = log(100+$viewscount)*pow(0.7, 1+0.15*$y*(-0.015*$matchtages*0.0092));
        // $z = 35*$matchtages/$usertages;
        $zmax = 12.5*($usertages/5);
        $z = 35*$matchtages/($usertages == 0 ? 1 : $usertages);
        $z = $z > $zmax ? $zmax : $z;
        $sum = $x+$y+$z;
        // echo $this->id." => ".$sum."<br>";
        return $x+$y+$z;
    }

    public function gallerycomments()
    {
        return $this->hasMany(Gallerycomment::class, 'contentid');
    }

    public function favorites()
    {
        return $this->hasMany(Galleryfavorite::class, 'contentid');
    }

    public function dislike()
    {
        return $this->hasMany(Gallerydislike::class, 'contentid');
    }
    public function like()
    {
        return $this->hasMany(Gallerylike::class, 'contentid');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'postid');
    }
    public function user(){
        return $this->belongsTo(User::class,'userid');
    }

    public function views()
    {
        return $this->hasMany(Contentview::class, 'contentid');
    }

    public function getFeaturedAttribute()
    {
        $yarray = collect([
            collect([
                "start" => 0,
                "end" => 1*24,
                "value" => 42,
            ]),collect([
                "start" => 1*24+1,
                "end" => 3*24,
                "value" => 8.25,
            ]),collect([
                "start" => 3*24+1,
                "end" => 5*24,
                "value" => 5.65,
            ]),collect([
                "start" => 5*24+1,
                "end" => 8*24,
                "value" => 3.33,
            ]),collect([
                "start" => 8*24+1,
                "end" => 11*24,
                "value" => 2.8,
            ]),collect([
                "start" => 11*24+1,
                "end" => 15*24,
                "value" => 2.5,
            ]),collect([
                "start" => 15*24+1,
                "end" => 24*24,
                "value" => 2,
            ]),collect([
                "start" => 24*24+1,
                "end" => 40*24,
                "value" => 1.78,
            ]),collect([
                "start" => 40*24+1,
                "end" => 60*24,
                "value" => 1.37,
            ]),collect([
                "start" => 60*24+1,
                "end" => 90*24,
                "value" => 1.28,
            ]),collect([
                "start" => 90*24+1,
                "end" => 180*24,
                "value" => 1.07,
            ]),collect([
                "start" => 180*24+1,
                "end" => 360*24,
                "value" => 1,
            ])
        ]);
        $viewscount = Cache::remember('view-'.$this->id, 60*3, function () {
            return $this->views()->count();
        });
        $usertages = Cache::remember('usertag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->count();
        });

        $matchtages = Cache::remember($this->id.'-contenttag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->whereIn('tagid', explode(",", $this->tag))->count();
        });

        $diffrenece = $this->created_at->diff(now());
        $diffrenecehours = $diffrenece->h+$diffrenece->d*24;
        $lastyele = $yarray->sortBy([['end', 'desc']])->first();
        if ($lastyele['end'] >= $diffrenecehours) {
            $yele = $yarray->where('start', '<=', $diffrenecehours)->where('end', '>=', $diffrenecehours)->first();
        } else {
            $yele = $lastyele;
        }
        $y = $yele['value'];

        $x = log(100+$viewscount)*pow(0.7, 1+0.15*$y*(-0.015*$matchtages*0.0092));

        $zmax = 12.5*($usertages/5);
        $z = 35*$matchtages/($usertages == 0 ? 1 : $usertages);
        $z = $z > $zmax ? $zmax : $z;

        return $x; //3
        // return $x+$y+$z;
    }

    public function getThirteenAttribute()
    {

        $yarray = collect([
            collect([
                "start" => 0,
                "end" => 1*24,
                "value" => 42,
            ]),collect([
                "start" => 1*24+1,
                "end" => 3*24,
                "value" => 8.25,
            ]),collect([
                "start" => 3*24+1,
                "end" => 5*24,
                "value" => 5.65,
            ]),collect([
                "start" => 5*24+1,
                "end" => 8*24,
                "value" => 3.33,
            ]),collect([
                "start" => 8*24+1,
                "end" => 11*24,
                "value" => 2.8,
            ]),collect([
                "start" => 11*24+1,
                "end" => 15*24,
                "value" => 2.5,
            ]),collect([
                "start" => 15*24+1,
                "end" => 24*24,
                "value" => 2,
            ]),collect([
                "start" => 24*24+1,
                "end" => 40*24,
                "value" => 1.78,
            ]),collect([
                "start" => 40*24+1,
                "end" => 60*24,
                "value" => 1.37,
            ]),collect([
                "start" => 60*24+1,
                "end" => 90*24,
                "value" => 1.28,
            ]),collect([
                "start" => 90*24+1,
                "end" => 180*24,
                "value" => 1.07,
            ]),collect([
                "start" => 180*24+1,
                "end" => 360*24,
                "value" => 1,
            ])
        ]);
        $viewscount = Cache::remember('view-'.$this->id, 60*3, function () {
            return $this->views()->count();
        });

        $usertages = Cache::remember('usertag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->count();
        });

        $matchtages = Cache::remember($this->id.'-contenttag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->whereIn('tagid', explode(",", $this->tag))->count();
        });

        $diffrenece = $this->created_at->diff(now());

        $diffrenecehours = $diffrenece->h+$diffrenece->d*24;
        $lastyele = $yarray->sortBy([['end', 'desc']])->first();
        if ($lastyele['end'] >= $diffrenecehours) {
            $yele = $yarray->where('start', '<=', $diffrenecehours)->where('end', '>=', $diffrenecehours)->first();
        } else {
            $yele = $lastyele;
        }
        $y = $yele['value'];

        $x = log(100+$viewscount)*pow(0.7, 1+0.15*$y*(-0.015*$matchtages*0.0092));

        $zmax = 12.5*($usertages/5);
        $z = 35*$matchtages/($usertages == 0 ? 1 : $usertages);
        $z = $z > $zmax ? $zmax : $z;
        $tot = $x+100;
        // echo "<pre>$tot";
        return $x+100;
    }

    //PRIORITISE POPULARITY (G)
    public function getPrioritiseAttribute(){

        $viewscount = Cache::remember('view-'.$this->id, 60*3, function () {
            return $this->views()->count();
        });
        $x = $viewscount*0.7;
        return $x;
    }

    public function getPrioritisetagsAttribute()
    {
        $yarray = collect([
            collect([
                "start" => 0,
                "end" => 1*24,
                "value" => 42,
            ]),collect([
                "start" => 1*24+1,
                "end" => 3*24,
                "value" => 8.25,
            ]),collect([
                "start" => 3*24+1,
                "end" => 5*24,
                "value" => 5.65,
            ]),collect([
                "start" => 5*24+1,
                "end" => 8*24,
                "value" => 3.33,
            ]),collect([
                "start" => 8*24+1,
                "end" => 11*24,
                "value" => 2.8,
            ]),collect([
                "start" => 11*24+1,
                "end" => 15*24,
                "value" => 2.5,
            ]),collect([
                "start" => 15*24+1,
                "end" => 24*24,
                "value" => 2,
            ]),collect([
                "start" => 24*24+1,
                "end" => 40*24,
                "value" => 1.78,
            ]),collect([
                "start" => 40*24+1,
                "end" => 60*24,
                "value" => 1.37,
            ]),collect([
                "start" => 60*24+1,
                "end" => 90*24,
                "value" => 1.28,
            ]),collect([
                "start" => 90*24+1,
                "end" => 180*24,
                "value" => 1.07,
            ]),collect([
                "start" => 180*24+1,
                "end" => 360*24,
                "value" => 1,
            ])
        ]);
        $viewscount = Cache::remember('view-'.$this->id, 60*3, function () {
            return $this->views()->count();
        });
        $usertages = Cache::remember('usertag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->count();
        });
        $matchtages = Cache::remember($this->id.'-contenttag-'.Auth::id(), 60*60, function () {
            return Usertag::where('userid', Auth::id())->whereIn('tagid', explode(",", $this->tag))->count();
        });
        $diffrenece = $this->created_at->diff(now());
        $diffrenecehours = $diffrenece->h+$diffrenece->d*24;
        $lastyele = $yarray->sortBy([['end', 'desc']])->first();
        if ($lastyele['end'] >= $diffrenecehours) {
            $yele = $yarray->where('start', '<=', $diffrenecehours)->where('end', '>=', $diffrenecehours)->first();
        } else {
            $yele = $lastyele;
        }
        $y = $yele['value'];
        // X = log(100+200) * 0.7^(1+0.15*42(-0.015*5(+0.0092))
        // X = log(100+views) * 0.7^(1+0.15*recency(-0.015*numberofmatchedtags(+0.0092))
        $x = log(100+$viewscount)*pow(0.7, 1+0.15*$y*(-0.015*$matchtages*0.0092));
        // $z = 35*$matchtages/$usertages;
        $zmax = 12.5*($usertages/5);
        $z = 35*$matchtages/($usertages == 0 ? 1 : $usertages);
        $z = $z > $zmax ? $zmax : $z;
        $z = 100*$z;
        $sum = $x+$y+$z;
        // echo $this->id." => ".$sum."<br>";
        return $x+$y+$z;
    }

    public function getDayAttribute()
    {
        $yarray = collect([
            collect([
                "start" => 0,
                "end" => 1*24,
                "value" => 42,
            ]),collect([
                "start" => 1*24+1,
                "end" => 3*24,
                "value" => 40,
            ]),collect([
                "start" => 3*24+1,
                "end" => 5*24,
                "value" => 40,
            ]),collect([
                "start" => 5*24+1,
                "end" => 8*24,
                "value" => 40,
            ]),collect([
                "start" => 8*24+1,
                "end" => 11*24,
                "value" => 2.8,
            ]),collect([
                "start" => 11*24+1,
                "end" => 15*24,
                "value" => 41,
            ]),collect([
                "start" => 15*24+1,
                "end" => 24*24,
                "value" => 40,
            ]),collect([
                "start" => 24*24+1,
                "end" => 40*24,
                "value" => 40,
            ]),collect([
                "start" => 40*24+1,
                "end" => 60*24,
                "value" => 41,
            ]),collect([
                "start" => 60*24+1,
                "end" => 90*24,
                "value" => 42,
            ]),collect([
                "start" => 90*24+1,
                "end" => 180*24,
                "value" => 40,
            ]),collect([
                "start" => 180*24+1,
                "end" => 360*24,
                "value" => 40,
            ]),collect([
                "start" => 360*24+1,
                "end" => 540*24,
                "value" => 41,
            ]),collect([
                "start" => 540*24+1,
                "end" => 800*24,
                "value" => 42,
            ])
        ]);

        $diffrenece = $this->created_at->diff(now());
        $diffrenecehours = $diffrenece->h+$diffrenece->d*24;
        $lastyele = $yarray->sortBy([['end', 'desc']])->first();
        if ($lastyele['end'] >= $diffrenecehours) {
            $yele = $yarray->where('start', '<=', $diffrenecehours)->where('end', '>=', $diffrenecehours)->first();
        } else {
            $yele = $lastyele;
        }

      return $d = $yele['value'];
    }
}
