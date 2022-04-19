<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'company', 'email', 'phone'
    ];

    public function assignedCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company');
    }
}
