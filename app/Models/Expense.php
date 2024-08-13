<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'amount',
        'expense_date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
