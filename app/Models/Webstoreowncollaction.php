<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webstoreowncollaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_name',
        'userid',
        'contentids',
    ];
}
