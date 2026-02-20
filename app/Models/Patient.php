<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'dni',
    'nombres',
    'apellidos',
    'fecha_nacimiento',
    'country_id',
    'phone'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

        public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
