<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $this->data['complaint'] = $complaints;
        return view('teacher.attendance.index', $this->data);
    }
}
