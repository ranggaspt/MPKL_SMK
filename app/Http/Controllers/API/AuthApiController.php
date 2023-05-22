<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => ['required', 'string', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            if (auth()->user()->role == 'student') {
                $sql = User::where('id', auth()->user()->id)->with('student')->get();
            // } elseif (auth()->user()->role == 3) {
            //     $sql = User::where('id', auth()->user()->id)->with('customer')->get();
            } else {
                $sql = 'Login Gagal';
            }
        } else {
            $sql = 'Login Gagal';
        }
        return response()->json($sql);
    }
}
