<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Area extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];
}
