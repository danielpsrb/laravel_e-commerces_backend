<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    //relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relationship with seller
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
