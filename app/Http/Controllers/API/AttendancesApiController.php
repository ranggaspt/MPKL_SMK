<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendancesApiController extends Controller
{
    function getPresensis()
    {
        $presensis = Attendance::where('student_id', Auth::user()->student->id)
        ->get();
        foreach ($presensis as $item) {
            if ($item->tanggal == date('Y-m-d')) {
                $item->is_hari_ini = true;
            } else {
                $item->is_hari_ini = false;
            }
            $datetime = Carbon::parse($item->tanggal)->locale('id');
            $masuk = Carbon::parse($item->masuk)->locale('id');
            $pulang = Carbon::parse($item->pulang)->locale('id');

            $datetime->settings(['formatFunction' => 'translatedFormat']);
            $masuk->settings(['formatFunction' => 'translatedFormat']);
            $pulang->settings(['formatFunction' => 'translatedFormat']);

            $item->tanggal = $datetime->format('l, j F Y');
            $item->masuk = $masuk->format('H:i');
            $item->pulang = $pulang->format('H:i');
        }
        return response()->json([
            'success' => true,
            'data' => $presensis,
            'message' => 'Sukses menampilkan data'
        ]);
    }

    function savePresensi(Request $request) 
    {
        $keterangan = "";
        $presensi = Attendance::whereDate('tanggal', '=', date('Y-m-d'))
                        ->where('student_id', Auth::user()->student->id)
                        ->first();
        if ($presensi == null) {
            $presensi = Attendance::create([
                'student_id' => Auth::user()->student->id,
                'teacher_id' => Auth::user()->student->teacher_id,
                'instance_id' => Auth::user()->student->instance_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'tanggal' => date('Y-m-d'),
                'masuk' => date('H:i:s'),
                // 'pulang' => date('H:i:s')
            ]);
        } else {
            $data = [
                'pulang' => date('H:i:s')
            ];

            Attendance::whereDate('tanggal', '=', date('Y-m-d'))
            ->where('student_id', Auth::user()->student->id)
            ->update($data);

        }
        $presensi = Attendance::whereDate('tanggal', '=', date('Y-m-d'))
                ->first();
        
        return response()->json([
            'success' => true,
            'data' => $presensi,
            'message' => 'Sukses simpan'
        ]);
    }

    // public function checkPresensi(Request $request)
    // {
    //     $date = Carbon::now()->toDateString();
    //     $studentId = $request->input('student_id');

    //     $presensi = Attendance::where('tanggal', $date)
    //         ->where('student_id', $studentId)
    //         ->first();

    //     $exists = $presensi !== null;

    //     return response()->json([
    //         'exists' => $exists
    //     ]);
    // }

}
