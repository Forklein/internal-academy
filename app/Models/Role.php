<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];
    
    //Relazione con User 1 a molti
    public function users() {
        return $this->hasMany(User::class);
    }
}
