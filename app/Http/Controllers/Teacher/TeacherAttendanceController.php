<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('teacher_id', '=', Auth::user()->teacher->id)
            ->select('student_id',)
            ->distinct()
            ->get();
        // dd($attendances);

        $this->data['attendance'] = $attendances;
        return view('teacher.attendance.index', $this->data);
    }

    public function show(string $id): View
    {
        $attendance = Attendance::where('student_id', Crypt::decrypt($id))->get();

        $this->data['attendance'] = $attendance;
        return view('teacher.attendance.detail', $this->data);
    }

    function map(string $id) {
        // dd(Attendance::findOrFail(Crypt::decrypt($id)));
        $attendance = Attendance::findOrFail(Crypt::decrypt($id));
        $this->data['attendances'] = $attendance;
        return view('teacher.attendance.detailmap', $this->data);
    }
}
