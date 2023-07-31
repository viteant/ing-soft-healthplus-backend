<?php

namespace App\Http\Controllers;

use App\Models\MedicalPrescription;
use Illuminate\Http\Request;

class MedicalPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MedicalPrescription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "user_id" => ["required"],
                "department" => ["required"],
                "position" => ["required"],
                "salary" => ["required"],
            ],
            [
                "user_id.required" => "No ha seleccionado ningún usuario.",
                "department.required" => "Debe seleccionar un departamento.",
                "position.required" => "Debe seleccionar una posición.",
                "salary.required" => "Debe ingresar un salario.",
            ]);

        $medical_prescription = MedicalPrescription::create($request->all());

        return response()->json(["message" => "Se ha creado el usuario administrativo con éxito.", "current_data" => $medical_prescription]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(MedicalPrescription::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medical_prescription = MedicalPrescription::findOrFail($id);
        $medical_prescription->update($request->all());
        $medical_prescription->save();

        return response()->json(["message" => "Se ha actualizado el usuario administrativo con éxito.", "current_data" => $medical_prescription]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medical_prescription = MedicalPrescription::findOrFail($id);
        $medical_prescription->delete();

        return response()->json(["message" => "Se ha eliminado el usuario administrativo con éxito."]);
    }
}
