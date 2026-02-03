<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blockuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_by',
        'block_to',
    ];

    public function user(){
        return $this->belongsTo(User::class,'block_to');
    }
    public function byuser(){
        return $this->belongsTo(User::class,'block_by');
    }
}
