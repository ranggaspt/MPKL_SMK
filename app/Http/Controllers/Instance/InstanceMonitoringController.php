<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstanceMonitoringController extends Controller
{
    public function index()
    {
        $student = Student::where('instance_id',"=",Auth::user()->instance->id)->get();

        $this->data['student'] = $student;
        return view('instance.monitoring.index', $this->data);
    }
}
