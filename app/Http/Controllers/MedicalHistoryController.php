<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MedicalHistory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "id_patient" => ["required"],
                "id_doctor" => ["required"],
                "date" => ["required"],
                "reason" => ["required"],
                "diagnosis" => ["required"],
                "treatment" => ["required"],
                "observations" => ["required"],
            ]);

        $medical_history = MedicalHistory::create($request->all());

        return response()->json(["message" => "Se ha creado el usuario administrativo con éxito.", "current_data" => $medical_history]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(MedicalHistory::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medical_history = MedicalHistory::findOrFail($id);
        $medical_history->update($request->all());
        $medical_history->save();

        return response()->json(["message" => "Se ha actualizado el usuario administrativo con éxito.", "current_data" => $medical_history]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medical_history = MedicalHistory::findOrFail($id);
        $medical_history->delete();

        return response()->json(["message" => "Se ha eliminado el usuario administrativo con éxito."]);
    }
}
