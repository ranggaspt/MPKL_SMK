<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

class InstanceParticipatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $data = [];
    public function index(Request $request)
    {
        if ($request->query('id') != "") {
            $id = Crypt::decrypt($request->query('id'));
            Session::put('package_id', $id);
        }
        $packageId = Session::get('package_id');
        $participants = Exam::select('participants.no_reg','participants.name','participants.no_identity','exams.id','exams.exam_result')
        ->join('participants','participants.id','=','exams.participant_id')
        ->where('exams.status','=','acc')
        ->where('exams.package_id',$packageId)
        ->where('exams.exam_status','=','selesai')
        ->get();
        $this->data['participants'] = $participants;
        return view('instance.participator.index', $this->data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
