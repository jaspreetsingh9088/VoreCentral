<?php

namespace App\Models;
use App\Models\Paidcontent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'paidcontent_id',
        'price',
        'quantity'
    ];

    public function paidcontent()
    {
        return $this->belongsTo(Paidcontent::class, 'paidcontent_id', 'id');
    }
}
