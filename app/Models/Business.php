<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function paymentMethodOptions()
    {
        return $this->hasMany(PaymentMethodOption::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }
}
