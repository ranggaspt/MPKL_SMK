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
        $file->storeAs('public/public/report', $file->hashName());

        //create post

        $report = Report::create([

            'student_id' => Auth::user()->student->id,
            'teacher_id' => Auth::user()->student->teacher_id,
            'description' => $request->description,
            'tanggal' => date('Y-m-d'),
            'file' => $file->hashName(),
        ]);
        $report = Report::whereDate('tanggal', '=', date('Y-m-d'))
            ->first();
        return new ReportsResource(true, 'Data laporan magang Berhasil Ditambahkan!', $report);
    }

    public function destroy($id)
    {
        try {
            $report = Report::find($id);

            if (!$report) {
                return response()->json(['message' => 'Jurnal tidak ditemukan'], 404);
            }
            $filePath = storage_path('app/public/public/report/' . $report->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $report->delete();

            return response()->json(['message' => 'report berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus jurnal'], 500);
        }
    }

    public function update(Request $request, $id) 
    {
        
    }
}
