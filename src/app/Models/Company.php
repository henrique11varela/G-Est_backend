<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        "name",
        "address",
        "postcode",
        "niss",
        "nipc"
    ];

    public static $rules = [
        "name" => "required",
        "address" => "required",
        "postcode" => "required",
        "niss" => "required",
        "nipc" => "required",
    ];
    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }

    public function companyPeople(): HasMany
    {
        return $this->hasMany(CompanyPerson::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
