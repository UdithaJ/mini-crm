<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'logo', 'website',
    ];

    public function companyEmployees(): HasMany
    {
        return $this->hasMany(employee::class, 'company');
    }
}
