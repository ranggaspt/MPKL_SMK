<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherMonitoringController extends Controller
{
    public function index()
    {
        $student = Student::where('teacher_id',"=",Auth::user()->teacher->id)->get();

        $this->data['student'] = $student;
        return view('teacher.monitoring.index', $this->data);
    }
}
