<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'description',
        'starts_at',
        'capacity',
    ];

    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
