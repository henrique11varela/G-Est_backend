<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'application_course', 'application_id', 'course_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}



