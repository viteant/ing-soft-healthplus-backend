<?php

namespace App\Http\Controllers;

use App\Models\Administrative;
use App\Models\User;
use App\Notifications\newAdministrativeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdministrativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Administrative::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "user.fullname" => ["required"],
            "user.email" => ["required", "unique:users,email"],
            "department" => ["required"],
            "position" => ["required"],
            "salary" => ["required"],
        ], [], [
            "user.email" => "email"
        ])->validate();

        # Create User and send Notification to the user email
        $password = Str::password(8);
        $user_info = $request->get('user');
        $user_info['password'] = Hash::make($password);
        $user_info['role_code'] = 'ADMINISTRATIVE';

        $user = User::create($user_info);
        $input = $request->all();
        $input["user_id"] = $user->id;
        $administrative = Administrative::create($input);

        $user->notify(new newAdministrativeUser($user->email, $password));


        return response()->json(["message" => "Se ha creado el usuario administrativo con éxito.", "current_data" => $administrative]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Administrative::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $administrative = Administrative::findOrFail($id);
        $administrative->update($request->all());
        $administrative->save();

        return response()->json(["message" => "Se ha actualizado el usuario administrativo con éxito.", "current_data" => $administrative]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $administrative = Administrative::findOrFail($id);
        $administrative->delete();

        return response()->json(["message" => "Se ha eliminado el usuario administrativo con éxito."]);
    }
}
