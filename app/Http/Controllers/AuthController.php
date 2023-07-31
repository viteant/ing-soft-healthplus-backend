<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Notifications\newUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expiration' => Carbon::now()->addMinutes(59),
            ]
        ]);
    }

    public function register(Request $request)
    {
        Validator::make([
            'user.fullname' => 'required|string|max:255',
            'user.email' => 'required|string|email|max:255|unique:users',
            'user.password' => 'required|string|min:6',
            "address" => ["required"],
            "phone" => ["required"],
            "dni" => ["required|max:10|min:10"],
            "billing_name" => ["required"],
            "billing_address" => ["required"],
            "billing_phone" => ["required"],
            "billing_document" => ["required|max:13|min:10"],
        ], [], [
            'user.fullname' => "name",
            'user.email' => "email",
            'user.password' => "password",
            "dni" => "national document",
            "billing_name" => "billing name",
            "billing_address" => "billing address",
            "billing_phone" => "billing phone",
            "billing_document" => "billing document",
        ])->validate();

        $user_info = $request->get("user");
        $user = User::create([
            'fullname' => $user_info["fullname"],
            'email' => $user_info["email"],
            'password' => Hash::make($user_info["password"]),
        ]);

        $input = $request->only("address",
            "phone",
            "dni",
            "billing_name",
            "billing_address",
            "billing_phone",
            "billing_document"
        );

        $input["user_id"] = $user->id;

        Patient::create($input);

        $user->notify(new newUser());

        return response()->json([
            'message' => 'Se ha creado el usuario con éxito, ya puede iniciar sesión.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
                'expiration' => Carbon::now()->addMinutes(59),
            ]
        ]);
    }
}
