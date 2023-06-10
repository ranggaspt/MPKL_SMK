<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileApiController extends Controller
{
    function index()
    {
        $student = Student::where('id',Auth::user()->student->id)->get();
        return response()->json([
            'success' => true,
            'data' => $student,
            'message' => 'Sukses menampilkan data'
        ]);
    }
}
