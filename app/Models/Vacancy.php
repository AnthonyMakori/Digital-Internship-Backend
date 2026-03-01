<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'location',
        'duration',
        'description',
        'requirements',
        'company_id',
        'status',
        'applicants'
    ];

    protected $casts = [
        'requirements' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
