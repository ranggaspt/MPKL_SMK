<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Instance;
use App\Models\Teacher;
use Illuminate\Http\Request;

class InstanceComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $this->data['complaint'] = $complaints;
        return view('instance.complaint.index', $this->data);
    }
    
    public function create()
    {
        $teachers = Teacher::orderBy('name', 'ASC')->get();
        $this->data['teachers'] = $teachers;
        return view('instance.complaint.create', $this->data);
    }
}
