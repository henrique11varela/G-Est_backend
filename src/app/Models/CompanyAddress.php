<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyAddress extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

}
