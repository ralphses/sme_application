<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'user_id',
        'payment_method_options_id',
        'customer_id',
        'order_date',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethodOption::class);
    }


    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
