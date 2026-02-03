<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paidcontentlike extends Model
{
    use HasFactory;
    protected $fillable = [
        'paidcontentid',
        'userid'
    ];
    public function paidcontent()
    {
        return $this->belongsTo(Paidcontent::class, 'paidcontentid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
