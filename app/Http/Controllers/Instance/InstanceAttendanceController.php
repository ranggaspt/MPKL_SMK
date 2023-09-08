<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InstanceAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('instance_id', '=', Auth::user()->instance->id)
            ->select('student_id',)
            ->distinct()
            ->get();
        // dd($attendances);

        $data['attendance'] = $attendances;
        return view('instance.attendance.index', $data);
    }

    public function show(string $id)
    {
        $attendance = Attendance::where('student_id', Crypt::decrypt($id))->get();

        $data['attendance'] = $attendance;
        return view('instance.attendance.detail', $data);
    }

    function map(string $id) {
        // dd(Attendance::findOrFail(Crypt::decrypt($id)));
        $attendance = Attendance::findOrFail(Crypt::decrypt($id));
        $data['attendances'] = $attendance;
        return view('instance.attendance.detailmap', $data);
    }
}
