<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'admin_id',
    ];


    //scope

    public function scopeMyRoles($query)
    {
        $query->where('admin_id', Auth::id());
    }


    //relations

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function employees()
    {
        return $this->hasMany(Admin::class, 'role_id');
    }

    public function visibletabs()
    {
        return $this->hasMany(Visibletab::class, 'role_id');
    }
}
