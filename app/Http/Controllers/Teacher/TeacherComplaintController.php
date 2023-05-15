<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TeacherComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('teacher_id',"=",Auth::user()->teacher->id)->get();
        $data['complaint'] = $complaints;
        return view('teacher.complaint.validation', $data);
    }

    public function terima($id)
    {
        // dd('1');
        $params['validation_message'] = 'terima';
        $complaint = Complaint::findOrFail(Crypt::decrypt($id));
        // $user = User::findOrFail($complaint->user_id);
        if ($complaint->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        }else{
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('teacher/complaint');
    }
    
    public function tolak($id)
    {
        $params['validation_message'] = 'tolak';
        $complaint = Complaint::findOrFail(Crypt::decrypt($id));
        // $user = User::findOrFail($complaint->user_id);
        if ($complaint->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        }else{
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('teacher/complaint');
    }
}
