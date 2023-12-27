<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }

    public function studentCollections(): BelongsToMany
    {
        return $this->belongsToMany(StudentCollection::class, 'student_student_collection', 'student_id', 'student_collection_id');
    }
}
