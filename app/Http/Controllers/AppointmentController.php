<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Models\Reason;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        $doctors = User::where('role', 'doctor')->get();
        $reasons = Reason::where('active', true)->get();

        $appointments = Appointment::with('patient')->get();

        // Preparar los eventos para FullCalendar
        $events = $appointments->map(function($appt) {
            return [
                'id' => $appt->id,
                'title' => $appt->patient->nombres ?? 'Paciente',
                'start' => $appt->start_time,
                'end' => $appt->end_time,
                'color' => '#198754', // verde, puedes cambiar según estado
            ];
        });

        return view('appointments.index', compact(
            'patients', 'doctors', 'reasons', 'appointments', 'events'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'reason_id' => 'required|exists:reasons,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'note' => 'nullable|string'
        ]);

        // 🔒 Verificar cruce de citas del mismo doctor
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['start_time' => 'El doctor ya tiene una cita en ese horario.'])
                ->withInput();
        }

        $appointment = Appointment::create([
        'patient_id' => $request->patient_id,
        'doctor_id' => $request->doctor_id,
        'reason_id' => $request->reason_id,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'duration' => $request->duration, // <-- agregar
        'note' => $request->note,
    ]);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Cita creada correctamente.');
    }
}
