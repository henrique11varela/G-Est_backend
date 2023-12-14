<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndedInternship extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }
}
