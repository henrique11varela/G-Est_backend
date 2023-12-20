<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['name', 'course_type_id', 'area_id'] ;

    public function studentCollections(): HasMany
    {
        return $this->hasMany(StudentCollection::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function courseType(): BelongsTo
    {
        return $this->belongsTo(CourseType::class);
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_course', 'course_id', 'application_id');
    }
}
