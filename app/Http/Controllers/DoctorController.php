<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Notifications\newAdministrativeUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
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
        return response()->json(Doctor::with('user')->get());
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
            "specialism" => ["required"],
            "degree" => ["required"],
            "service_price" => ["required"],
        ], [], [
            "user.email" => "email"
        ])->validate();

        # Create User and send Notification to the user email
        $password = Str::password(8);
        $user_info = $request->get('user');
        $user_info['password'] = Hash::make($password);
        $user_info['role_code'] = 'DOCTOR';

        $user = User::create($user_info);

        $input = $request->all();
        $input["user_id"] = $user->id;
        $doctor = Doctor::create($input);

        $user->notify(new newAdministrativeUser($user->email, $password));

        return response()->json(["message" => "Se ha creado el doctor con éxito.", "current_data" => $doctor]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Doctor::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());
        $doctor->save();

        return response()->json(["message" => "Se ha actualizado el doctor con éxito.", "current_data" => $doctor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return response()->json(["message" => "Se ha eliminado el doctor con éxito."]);
    }
}
