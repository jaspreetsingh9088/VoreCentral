<?php

namespace App\Models;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'meta_title',
        'title',
        'alias',
        'meta_description',
        'meta_tag',
    ];
    
    
    public function sections()
    {
        return $this->hasMany(section::class,'cid');
    }
    
}
