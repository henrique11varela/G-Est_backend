<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class StudentCollection extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_student_collection', 'student_collection_id', 'student_id');
    }

    public function Course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function internships(): hasMany
    {
        return $this->hasMany(Internship::class);
    }

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];

}
