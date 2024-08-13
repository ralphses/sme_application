<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'report_type',
        'start_date',
        'end_date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
