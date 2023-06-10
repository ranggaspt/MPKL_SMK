<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherJournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('teacher_id',"=",Auth::user()->teacher->id)->get();
        $this->data['journal'] = $journals;
        return view('teacher.journal.index', $this->data);
    }
}
