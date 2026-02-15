<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctors = Doctor::with('user')->latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('doctors.create'); // solo el formulario
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'dni' => 'required|unique:doctors',
        'nombres' => 'required',
        'apellidos' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    // Crear usuario con rol doctor
    $user = User::create([
        'name' => $request->nombres . ' ' . $request->apellidos,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'doctor'
    ]);

    // Crear perfil doctor
    Doctor::create([
        'user_id' => $user->id,
        'dni' => $request->dni,
        'nombres' => $request->nombres,
        'apellidos' => $request->apellidos,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'nacionalidad' => $request->nacionalidad,
        'especialidad' => $request->especialidad,
    ]);

    return redirect()->route('doctors.index')
        ->with('success', 'Doctor creado correctamente');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'dni' => 'required|string|max:20',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'nacionalidad' => 'nullable|string|max:255',
        ]);

        $doctor->update([
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'especialidad' => $request->especialidad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'nacionalidad' => $request->nacionalidad,
        ]);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor eliminado correctamente.');
    }
}
