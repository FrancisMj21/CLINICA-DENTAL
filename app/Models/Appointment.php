<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'reason_id',
        'start_time',
        'end_time',
        'note'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relación con doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relación con motivo
    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
