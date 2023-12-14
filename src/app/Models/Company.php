<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }

    public function companyPeople(): HasMany
    {
        return $this->hasMany(CompanyPerson::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
