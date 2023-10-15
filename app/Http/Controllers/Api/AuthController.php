<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {

        $data = Validator::make($request->all(), [
            'name'                      => ['required', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'                  => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'password_confirmation'     => ['required', 'string', 'max:255'],
        ]);

        if ($data->fails()) {
            return response()->json([
                $data->errors()
            ], 422);
        }

        $validatedData = $data->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'success'       => true,
            'user'          => $user,
            'accessToken'   => $accessToken,
        ], 200);

    }

    public function login(Request $request)
    {

       $data = Validator::make($request->all(), [
            'email'      => ['required', 'email', 'max:255'],
            'password'   => ['required', 'max:255'],
        ]);

        if($data->fails())
        {
            return response()->json([
                $data->errors()
            ], 422);
        }

        $validatedData = $data->validated();

        if(!Auth::attempt($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login details'
            ], 422);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response()->json([
            'success'       => true,
            'user'          => Auth::user(),
            'accessToken'   => $accessToken,
        ], 200);

    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();

            return response()->json([
                'success'       => true,
            ], 200);

        } else {
            return response()->json([
                'success'       => false,
            ], 401);
        }
    }
}
