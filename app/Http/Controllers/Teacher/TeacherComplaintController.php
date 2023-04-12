<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('teacher_id',"=",Auth::user()->teacher->id)->get();
        $this->data['complaint'] = $complaints;
        return view('teacher.complaint.validation', $this->data);
    }
}
