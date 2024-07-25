<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'address_id',
        'seller_id',
        'total_price',
        'shipping_price',
        'grand_total',
        'status',
        'payment_method',
        'payment_va_name',
        'payment_va_number',
        'payment_wallet_name',
        'payment_wallet_number',
        'shipping_service',
        'shipping_number',
        'transaction_number',
    ];

    /**
     * Get the user that owns the order.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the address that owns the order.
     */

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the seller that owns the order.
     */

    public function seller()
    {
        return $this->belongsTo(User::class);
    }
}
