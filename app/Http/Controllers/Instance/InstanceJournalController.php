<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class InstanceJournalController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $this->data['complaint'] = $complaints;
        return view('instance.journal.validation', $this->data);
    }
}
