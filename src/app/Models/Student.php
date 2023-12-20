<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

    use SoftDeletes;

    public static $validations = [
        'name' => 'required',
        'personal_email' => 'required',
        'atec_email' => 'required',
        'phone_number' => 'required',
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
