<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
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
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'dni' => 'required|string|max:20|unique:doctors,dni',
        'nombres' => 'required',
        'apellidos' => 'required',
        'specialty_id' => 'required|exists:specialties,id',
        'phone' => 'nullable|digits_between:6,15',
        'country_id' => 'nullable|exists:countries,id',
    ]);

     DB::transaction(function () use ($request) {

        $user = User::create([
            'name' => $request->nombres . ' ' . $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor'
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'specialty_id' => $request->specialty_id,
            'country_id' => $request->country_id,
            'phone' => $request->phone,
        ]);

    });

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
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'dni' => 'required|string|max:20|unique:doctors,dni,' . $doctor->id,
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'specialty_id' => 'nullable|exists:specialties,id',
            'country_id' => 'nullable|exists:countries,id',
            'phone' => 'nullable|digits_between:6,15',
        ]);

        $doctor->update($request->only([
            'dni',
            'nombres',
            'apellidos',
            'specialty_id',
            'country_id',
            'phone',
            'fecha_nacimiento'
        ]));

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
        DB::transaction(function () use ($doctor) {
        $doctor->user()->delete();
        $doctor->delete();
    });

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor eliminado correctamente.');
    }
}
