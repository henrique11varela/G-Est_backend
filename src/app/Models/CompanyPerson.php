<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPerson extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'company_id',
        'is_tutor',
        'is_contact',
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
