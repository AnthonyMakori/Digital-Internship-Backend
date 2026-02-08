<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Role Constants (Recommended for consistency)
    |--------------------------------------------------------------------------
    */

    public const ROLE_STUDENT = 'Student';
    public const ROLE_LECTURER = 'Lecturer';
    public const ROLE_COMPANY = 'Company';

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role',
        'role_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Fields
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isStudent()
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isLecturer()
    {
        return $this->role === self::ROLE_LECTURER;
    }

    public function isCompany()
    {
        return $this->role === self::ROLE_COMPANY;
    }
}
