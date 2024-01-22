<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function internships(): BelongsToMany
    {
        return $this->belongsToMany(Internship::class);
    }

    public function companyPeople(): HasMany
    {
        return $this->hasMany(CompanyPerson::class);
    }
    public function companyAddress(): HasMany
    {
        return $this->hasMany(CompanyAddress::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
    public function contactPeople()
    {
        return $this->companyPeople()->where('is_contact', '=', 1);
    }
    public function tutorPeople()
    {

        return $this->companyPeople()->where('is_tutor', '=', 1);
    }
}
