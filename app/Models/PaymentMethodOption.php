<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'method_name',
        'details',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
