<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Invoice::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "patient_appointment_id" => ["required"],
                "patient_id" => ["required"],
                "date" => ["required"],
                "value" => ["required"],
            ],
            [
                "patient_appointment_id.required" => "No ha ingresado ninguna cita de paciente.",
                "patient_id.required" => "No ha seleccionado ningún paciente.",
                "date.required" => "No ha ingresado ninguna fecha.",
                "value.required" => "No ha ingresado ningún valor."
            ]);

        $invoice = Invoice::create($request->all());

        return response()->json(["message" => "Se ha creado la factura con éxito.", "current_data" => $invoice]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Invoice::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());
        $invoice->save();

        return response()->json(["message" => "Se ha actualizado la factura con éxito.", "current_data" => $invoice]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(["message" => "Se ha eliminado la factura con éxito."]);
    }
}
