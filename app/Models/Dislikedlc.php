<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislikedlc extends Model
{
    use HasFactory;
    protected $fillable = [
        'dlcid',
        'userid',
    ];
    public function content()
    {
        return $this->belongsTo(Dlccontents::class, 'dlcid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
