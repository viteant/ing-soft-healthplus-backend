<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Account::all());
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "code" => ["required"],
            "plan_description" => ["required"],
        ], [
            "code.required" => "Debe inrgesar un código.",
            "plan_description.required" => "Debe ingresar una descripción.",
        ])->validate();

        $account = Account::create($request->all());

        return response()->json(["message" => "Se ha creado la cuenta con éxito.", "current_data" => $account]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Account::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);
        $account->update($request->all());
        $account->save();

        return response()->json(["message" => "Se ha actualizado la cuenta con éxito.", "current_data" => $account]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json(["message" => "Se ha eliminado la cuenta con éxito."]);

    }
}
