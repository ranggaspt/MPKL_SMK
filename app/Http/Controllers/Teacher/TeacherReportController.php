<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TeacherReportController extends Controller
{
    public function index()
    {
        // dd('awal');
        $reports = Report::where('teacher_id', "=", Auth::user()->teacher->id)
        ->select('student_id',)
        ->distinct()
        ->get();
        $data['report'] = $reports;
        return view('teacher.report.index', $data);
    }

    public function show(string $id): View
    {
        $report = Report::where('student_id', Crypt::decrypt($id))->get();

        $data['report'] = $report;
        return view('teacher.report.detail', $data);
    }

}
