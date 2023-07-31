<?php

namespace App\Http\Controllers;

use App\Models\PatientAppointment;
use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PatientAppointment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "attention_schedule_id" => ["required"],
                "patient_id" => ["required"],
            ]);

        $patient_appointment = PatientAppointment::create($request->all());

        return response()->json(["message" => "Se ha creado la cita del paciente con éxito.", "current_data" => $patient_appointment]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(PatientAppointment::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient_appointment = PatientAppointment::findOrFail($id);
        $patient_appointment->update($request->all());
        $patient_appointment->save();

        return response()->json(["message" => "Se ha actualizado la cita del paciente con éxito.", "current_data" => $patient_appointment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient_appointment = PatientAppointment::findOrFail($id);
        $patient_appointment->delete();

        return response()->json(["message" => "Se ha eliminado la cita del paciente con éxito."]);
    }
}
