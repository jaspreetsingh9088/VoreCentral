<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contentview extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'viewerid',
        'contentid',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function viwerid()
    {
        return $this->belongsTo(User::class, 'viewerid');
    }
}
