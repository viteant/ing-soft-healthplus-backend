<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'role' => ["required"],
                'description' => ["required"],
            ]);

        $role = Role::create($request->all());

        return response()->json(["message" => "Se ha creado el rol con éxito.", "current_data" => $role]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Role::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->save();

        return response()->json(["message" => "Se ha actualizado el rol con éxito.", "current_data" => $role]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(["message" => "Se ha eliminado el rol con éxito."]);
    }
}
