<?php

namespace App\Http\Controllers;

use App\Models\MedicalCertificate;
use Illuminate\Http\Request;

class MedicalCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MedicalCertificate::all());
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
                "description" => ["required"],
            ],
            [
                "id_patient.required" => "No ha registrado ningún paciente.",
                "id_doctor.required" => "No ha registrado ningún doctor.",
                "date.required" => "No ha registrado ninguna fecha.",
                "description.required" => "No ha registrado ninguna descripción.",
            ]);

        $medical_certificate = MedicalCertificate::create($request->all());

        return response()->json(["message" => "Se ha creado el certificado con éxito.", "current_data" => $medical_certificate]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(MedicalCertificate::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $medical_certificate->update($request->all());
        $medical_certificate->save();

        return response()->json(["message" => "Se ha actualizado el certificado con éxito.", "current_data" => $medical_certificate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medical_certificate = MedicalCertificate::findOrFail($id);
        $medical_certificate->delete();

        return response()->json(["message" => "Se ha eliminado el certificado con éxito."]);
    }
}
