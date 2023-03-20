<?php

namespace App\Http\Controllers\Instance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParticipantRequest;
use App\Http\Requests\UserRequest;
use App\Models\Participant;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Exam;
class InstanceMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('id') != "") {
            $id = Crypt::decrypt($request->query('id'));
            Session::put('package_id', $id);
        }
        $packageId = Session::get('package_id');
        $participants = Exam::select('participants.no_reg','participants.name','exams.id')
        ->join('participants','participants.id','=','exams.participant_id')
        ->where('exams.status','=','acc')
        ->where('exams.package_id',$packageId)
        ->get();
        // $participants = Participant::whereNotIn('id',function($q){
        //     $q->select('participant_id')->from('members');
        // })->get();
        $members = Exam::select('participants.no_reg','participants.name','exams.id','exams.status')
        ->join('participants','participants.id','=','exams.participant_id')
        ->where('exams.status','!=','acc')
        ->where('exams.package_id',$packageId)
        ->get();
        // $members = Participant::join('members','participants.id','=','members.participant_id')->where('members.package_id',$packageId)->get();
        $this->data['participants'] = $participants;
        $this->data['list_member'] = $members;
        return view('instance.member.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Exam::findOrFail($id);
        if ($package->update(['status' => 'cancel'])) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }
        return redirect('instance/member');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Exam::findOrFail($id);
        if ($package->update(['status' => 'acc'])) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }
        return redirect('instance/member');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $package = Exam::findOrFail($id);
    //     if ($package->update(['status' => 'cancel'])) {
    //         alert()->success('Success','Data Berhasil Disimpan');
    //     } else {
    //         alert()->error('Error','Data Gagal Disimpan');
    //     }
    //     return redirect('instance/member');
    // }

    public function hapus($id)
    {
        
    }
}
