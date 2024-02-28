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

    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    protected $primaryKey = 'internship_id';

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }
}
