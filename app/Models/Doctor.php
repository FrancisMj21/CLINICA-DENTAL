<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dni',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'nacionalidad',
        'country_id',
        'phone',
        'specialty_id'
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

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }


}
