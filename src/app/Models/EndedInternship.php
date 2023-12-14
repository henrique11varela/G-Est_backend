<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EndedInternship extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }
}
