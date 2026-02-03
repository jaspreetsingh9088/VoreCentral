<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visibletab extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'role_id',
        'tab_id',
        'visible',
        'add_row',
        'update_row',
        'delete_row'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function tab()
    {
        return $this->belongsTo(Tab::class, 'tab_id');
    }
}
