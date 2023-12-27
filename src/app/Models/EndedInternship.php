<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EndedInternship extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }

    public function endState(): BelongsTo
    {
        return $this->belongsTo(EndState::class);
    }
}
