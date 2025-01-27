<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
