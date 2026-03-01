<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo',
        'description',
        'industry',
        'location'
    ];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
