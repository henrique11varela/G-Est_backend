<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseType extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
