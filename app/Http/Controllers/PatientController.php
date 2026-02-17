<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('user')->latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:patients',
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->nombres . ' ' . $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient'
        ]);

        Patient::create([
            'user_id' => $user->id,
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'nacionalidad' => $request->nacionalidad,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Paciente creado correctamente');
    }

    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'dni' => 'required|string|max:20',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string|max:255',
        ]);

        $patient->update($request->only([
            'dni',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'nacionalidad'
        ]));

        return redirect()->route('patients.index')
            ->with('success', 'Paciente actualizado correctamente');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Paciente eliminado correctamente');
    }
}
