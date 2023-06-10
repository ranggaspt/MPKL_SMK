<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Report;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TeacherReportController extends Controller
{
    public function index()
    {
        // dd('awal');
        $reports = Report::where('teacher_id', "=", Auth::user()->teacher->id)->get();
        $this->data['report'] = $reports;
        return view('teacher.report.index', $this->data);
    }

}
