<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profilepost extends Model
{
    use HasFactory;
    protected $fillable = [
        'post',
        'userid',
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'userid');
    }
}
