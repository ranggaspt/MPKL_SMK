<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class JournalApiController extends Controller
{
    public function index()
    {
        $journals = Journal::where('student_id', Auth::user()->student->id)
            ->get();
        return response()->json([
            'success' => true,
            'data' => $journals,
            'message' => 'Sukses menampilkan data'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'list_jurnals' => 'required|string|max:255',
        ]);
        $journal = Journal::where('student_id', Auth::user()->student->id)
            ->first();
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // if ($journal == null) {
        $journal = Journal::create([
            'student_id' => Auth::user()->student->id,
            'teacher_id' => Auth::user()->student->teacher_id,
            'instance_id' => Auth::user()->student->instance_id,
            'list_jurnals' => $request->list_jurnals,
            'tanggal' => date('Y-m-d'),
            'validation_jurnal' => "proses",
        ]);
        // }
        $journal = Journal::whereDate('tanggal', '=', date('Y-m-d'))
            ->first();

        return response()->json([
            'success' => true,
            'data' => $journal,
            'message' => 'Sukses simpan'
        ]);
    }

    // public function show($id)
    // {
    //     $journal = Journal::findOrFail($id);

    //     if (!$journal) {
    //         return response()->json(['message' => 'Data not found'], 404);
    //     }

    //     return response()->json($journal, 200);
    // }

    public function destroy($id)
    {
        try {
            $journal = Journal::find($id);
    
            if (!$journal) {
                return response()->json(['message' => 'Jurnal tidak ditemukan'], 404);
            }
    
            $journal->delete();
    
            return response()->json(['message' => 'Jurnal berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus jurnal'], 500);
        }
    }

}
