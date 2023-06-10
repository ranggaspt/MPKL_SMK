<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Models\Complaint;
use App\Models\Instance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InstanceComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('instance_id',"=",Auth::user()->instance->id)->get();
        $this->data['complaint'] = $complaints;
        return view('instance.complaint.index', $this->data);
    }
    
    public function create()
    {
        $student = Student::where('instance_id',"=",Auth::user()->instance->id)->get();
        $this->data['student'] = $student;
        return view('instance.complaint.create', $this->data);
    }

    public function store(ComplaintRequest $request)
    {
        
        $params = $request->all();
        $params['instance_id'] =auth()->user()->instance->id;
        $params['teacher_id'] =auth()->user()->instance->teacher_id;
        
        Complaint::create($params);
        
        return redirect('instance/complaint');
    }

    public function edit($id)
    {
        // dd(Complaint::findOrFail(Crypt::decrypt($id)));
        $student = Student::where('instance_id',"=",Auth::user()->instance->id)->get();
        $this->data['student'] = $student;
        $complaint = Complaint::findOrFail(Crypt::decrypt($id));
        $this->data['complaints'] = $complaint;
        return view('instance.complaint.edit', $this->data);
    }

    public function update(ComplaintRequest $request1 ,$id)
    {
        $params1 = $request1->all();
        // $params2['username'] = $request2->username;

        $complaint = Complaint::findOrFail(Crypt::decrypt($id));
        // $user = User::findOrFail($complaint->user_id);
        if ($complaint->update($params1)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('instance/complaint');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail(Crypt::decrypt($id));

        if ($complaint->delete()) {
            // $user = User::findOrFail($student->user_id);
            // $user->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('instance/complaint');
    }
}
