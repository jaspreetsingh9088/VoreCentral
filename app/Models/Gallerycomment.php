<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerycomment extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid',
        'contentid',
        'comment'
    ];

    public function content()
    {
        return $this->belongsTo(Usercontent::class, 'contentid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
