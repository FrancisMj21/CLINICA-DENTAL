<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        'dni' => 'required|string|max:20|unique:patients,dni',
        'nombres' => 'required',
        'apellidos' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'country_id' => 'nullable|exists:countries,id',
        'phone' => 'nullable|digits_between:6,15',
    ]);

        DB::transaction(function () use ($request) {

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
                'country_id' => $request->country_id,
                'phone' => $request->phone,
            ]);

        });

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
            'dni' => 'required|string|max:20|unique:patients,dni,' . $patient->id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'country_id' => 'nullable|exists:countries,id',
            'phone' => 'nullable|digits_between:6,15',
        ]);

        $patient->update($request->only([
            'dni',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'country_id',
            'phone',
        ]));

        return redirect()->route('patients.index')
            ->with('success', 'Paciente actualizado correctamente');
    }

        public function destroy(Patient $patient)
    {
        DB::transaction(function () use ($patient) {
            $patient->user()->delete();
            $patient->delete();
        });

        return redirect()->route('patients.index')
            ->with('success', 'Paciente eliminado correctamente');
    }
}
