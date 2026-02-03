<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'admin_id',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //scope

    public function scopeEmployee($query)
    {
        $query->whereNotNull('role_id');
    }

    public function scopeMyEmployee($query)
    {
        $query->where('admin_id', Auth::id());
    }


    //relations

    public function roles()
    {
        return $this->hasMany(Role::class, 'admin_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function parent()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function child()
    {
        return $this->hasMany(Admin::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
