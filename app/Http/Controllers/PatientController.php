<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Patient::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "user_id" => ["required"],
                "address" => ["required"],
                "phone" => ["required"],
                "dni" => ["required"],
                "billing_name" => ["required"],
                "billing_address" => ["required"],
                "billing_phone" => ["required"],
                "billing_document" => ["required"],
            ]);

        $patient = Patient::create($request->all());

        return response()->json(["message" => "Se ha creado el paciente con éxito.", "current_data" => $patient]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Patient::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        $patient->save();

        return response()->json(["message" => "Se ha actualizado el paciente con éxito.", "current_data" => $patient]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(["message" => "Se ha eliminado el paciente con éxito."]);
    }
}
