<?php

namespace App\Models;

use App\Enum\TabTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'icon',
        'name',
        'status',
        'position',
        'type', // 'main', 'tabmain', 'tab'
        'tab_id'
    ];

    protected $casts = ['type' => TabTypeEnum::class];


    public function maintab()
    {
        return $this->belongsTo(Tab::class, 'tab_id');
    }

    public function tabs()
    {
        return $this->hasMany(Tab::class, 'tab_id');
    }

    public function visibletabs()
    {
        return $this->hasMany(Visibletab::class, 'tab_id');
    }

    public function getIsTabMain()
    {
        return $this->type ==  TabTypeEnum::TABMAIN;
    }

    protected function IsTabMain(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type == TabTypeEnum::TABMAIN,
        );
    }
}
