<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required|username',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            if (auth()->user()->level == 2) {
                $sql = User::where('id', auth()->user()->id)->with('kurir')->get();
            } elseif (auth()->user()->level == 3) {
                $sql = User::where('id', auth()->user()->id)->with('customer')->get();
            } else {
                $sql = 'Login Gagal';
            }
        } else {
            $sql = 'Login Gagal';
        }
        return response()->json($sql);
    }
}
