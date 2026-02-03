<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owncollaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'contentids','collection_name','userid','featured'
    ];
}
