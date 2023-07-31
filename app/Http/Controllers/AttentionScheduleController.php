<?php

namespace App\Http\Controllers;

use App\Models\AttentionSchedule;
use Illuminate\Http\Request;

class AttentionScheduleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AttentionSchedule::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "doctor_id" => ["required"],
                "days" => ["required"],
                "start" => ["required"],
                "end" => ["required"],
            ],
            [
                "doctor_id.required" => "Debe seleccionar algún médico.",
                "days.required" => "Debe seleccionar por lo menos un día de la semana.",
                "start.required" => "Debe seleccionar una hora de inicio.",
                "end.required" => "Debe seleccionar una hora de fin.",
            ]);

        $attentionSchedule = AttentionSchedule::create($request->all());

        return response()->json(["message" => "Se ha creado el usuario administrativo con éxito.", "current_data" => $attentionSchedule]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(AttentionSchedule::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attentionSchedule = AttentionSchedule::findOrFail($id);
        $attentionSchedule->update($request->all());
        $attentionSchedule->save();

        return response()->json(["message" => "Se ha actualizado el usuario administrativo con éxito.", "current_data" => $attentionSchedule]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attentionSchedule = AttentionSchedule::findOrFail($id);
        $attentionSchedule->delete();

        return response()->json(["message" => "Se ha eliminado el usuario administrativo con éxito."]);
    }
}
