<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EndState extends Model
{
    use HasFactory;

    public function endedInternships(): HasMany
    {
        return $this->hasMany(EndedInternship::class);
    }
}
