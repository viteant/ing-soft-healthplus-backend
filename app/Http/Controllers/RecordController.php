<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Record::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "account_id" => ["required"],
                "date" => ["required"],
                "value" => ["required"],
            ]);

        $record = Record::create($request->all());

        return response()->json(["message" => "Se ha creado el usuario administrativo con éxito.", "current_data" => $record]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Record::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Record::findOrFail($id);
        $record->update($request->all());
        $record->save();

        return response()->json(["message" => "Se ha actualizado el usuario administrativo con éxito.", "current_data" => $record]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Record::findOrFail($id);
        $record->delete();

        return response()->json(["message" => "Se ha eliminado el usuario administrativo con éxito."]);
    }
}
