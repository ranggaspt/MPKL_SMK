<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('teacher_id',"=",Auth::user()->teacher->id)->get();
        $this->data['attendance'] = $attendances;
        return view('teacher.attendance.index', $this->data);
    }
}
