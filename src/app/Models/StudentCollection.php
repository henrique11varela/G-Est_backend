<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];
    
}
