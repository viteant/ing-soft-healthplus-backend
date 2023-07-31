<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Laboratory::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "medical_history_id" => ["required"],
                "type" => ["required"],
                "description" => ["required"],
                "status" => ["required"],
                "results" => ["required"],
            ],
            [
                "medical_history_id.required" => "No ha registrado ningún historial médico.",
                "type.required" => "No ha registrado ningún tipo.",
                "description.required" => "No ha registrado ninguna descripción.",
                "status.required" => "No ha registrado ningún status.",
                "results.required" => "No ha registrado ningún resultado.",
            ]);

        $laboratory = Laboratory::create($request->all());

        return response()->json(["message" => "Se ha creado la prueba de laboratorio con éxito.", "current_data" => $laboratory]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Laboratory::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->update($request->all());
        $laboratory->save();

        return response()->json(["message" => "Se ha actualizado la prueba de laboratorio con éxito.", "current_data" => $laboratory]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->delete();

        return response()->json(["message" => "Se ha eliminado la prueba de laboratorio con éxito."]);
    }
}
