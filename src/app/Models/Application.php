<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $validations = [
        'company_name' => 'required',
        'activity_sector' => 'required',
        'locality' => 'required',
        'website' => 'required',
        'contact_name' => 'required',
        'contact_telephone' => 'required',
        'contact_email' => 'required',
        'number_students' => 'required',
        'student_profile' => 'required',
        'student_tasks' => 'required',
        'company_id' => 'required',
        'is_partner' => 'required',
        'is_valid' => 'required',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'application_course', 'application_id', 'course_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}



