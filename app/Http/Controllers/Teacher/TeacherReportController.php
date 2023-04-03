<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class TeacherReportController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $this->data['complaint'] = $complaints;
        return view('teacher.report.index', $this->data);
    }
}
