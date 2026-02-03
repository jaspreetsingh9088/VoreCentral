<?php

namespace App\Models;
use App\Models\{Usercontent,Paidcontent};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];

    public function usercontents()
    {
        return $this->hasMany(Usercontent::class,'tags');
    }

    public function paidcontents()
    {
        return $this->belongsT(Paidcontent::class,'tag_id');
    }
}
