<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class AuthApiController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => ['required', 'string', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            $sql = 'Login Gagal';
        } else {           
            if (auth()->user()->role == 'student') {
                $sql = User::where('id', auth()->user()->id)->with('student')->firstOrFail();
                $token = $sql->createToken('auth_token')->plainTextToken;
                $sql->token = $token;
                $sql->token_type = 'Bearer';

                return response()
                    ->json([
                        'success' => true,
                        'message' => 'Hi ' . $sql->name . ', selamat datang di sistem presensi',
                        'data' => $sql
                    ]);
                // } elseif (auth()->user()->role == 3) {
                //     $sql = User::where('id', auth()->user()->id)->with('customer')->get();
            } else {
                $sql = 'Login Gagal';
            }
        }

        // return response()->json($sql);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful.'
        ]);
    }
}
