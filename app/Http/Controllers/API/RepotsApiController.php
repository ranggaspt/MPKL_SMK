<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\Report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepotsApiController extends Controller
{
    public function index()
    {
        $reports = Report::where('student_id', Auth::user()->student->id)
        ->get();
    return response()->json([
        'success' => true,
        'data' => $reports,
        'message' => 'Sukses menampilkan data'
    ]);
}

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
            'description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $file = $request->file('file');
        $file->storeAs('public/report', $file->hashName());

        //create post
        $report = Report::whereDate('tanggal', '=', date('Y-m-d'))
                ->first();
        $report = Report::create([
            'file' => $file->hashName(),
            'student_id' => Auth::user()->student->id,
            'teacher_id' => Auth::user()->student->teacher_id,
            'description' => $request->description,
            'tanggal' => date('Y-m-d'),
        ]);
        // $report = Report::whereDate('tanggal', '=', date('Y-m-d'))
        //         ->first();

        //return response
        return new ReportsResource(true, 'Data laporan magang Berhasil Ditambahkan!', $report);
    }
}
