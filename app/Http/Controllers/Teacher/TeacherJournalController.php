<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Journal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TeacherJournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('teacher_id', "=", Auth::user()->teacher->id)
            ->select('student_id',)
            ->distinct()
            ->get();
        $this->data['journal'] = $journals;
        return view('teacher.journal.index', $this->data);
    }

    public function show(string $id): View
    {
        $journal = Journal::where('student_id', Crypt::decrypt($id))->get();

        $this->data['journal'] = $journal;
        return view('teacher.journal.detail', $this->data);
    }
}
