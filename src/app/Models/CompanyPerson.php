<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPerson extends Model
{
    use HasFactory;

    use SoftDeletes;

    public static $validations = [
        'name' => 'required',
        'phone_number' => 'required',
        'email' => 'required',
        'company_id' => 'required',
        'is_tutor' => 'required',
        'is_contact' => 'required',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }
}
