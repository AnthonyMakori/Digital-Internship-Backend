<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model {
    protected $fillable = ['name', 'location'];

    public function faculties() {
        return $this->hasMany(Faculty::class);
    }
}
