<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Internship extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function endedInternship(): HasOne
    {
        return $this->hasOne(EndedInternship::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function companyPerson(): BelongsTo
    {
        return $this->belongsTo(CompanyPerson::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}
