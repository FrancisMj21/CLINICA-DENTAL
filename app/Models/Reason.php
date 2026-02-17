<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'name',
        'default_duration',
        'active'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
