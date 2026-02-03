<?php

namespace App\Models;
use App\Models\{Usercontent,Paidcontent};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagoption extends Model
{
    use HasFactory;
    protected $table = "tag_options";
    protected $fillable = [
        'user_id',
        'tags',
        'antitag'
    ];
}
