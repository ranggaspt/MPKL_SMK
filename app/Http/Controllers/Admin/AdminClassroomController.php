<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Study;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class AdminClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $data['classrooms'] = $classrooms;
        return view('admin.classroom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studies = Study::orderBy('name', 'ASC')->get();
        $data['studies'] = $studies;
        return view('admin.classroom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        if (Classroom::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/classroom');
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
        $studies = Study::orderBy('name', 'ASC')->get();
        $data['studies'] = $studies;
        $classroom = Classroom::findOrFail(Crypt::decrypt($id));
        $data['data'] = $classroom;
        return view('admin.classroom.edit', $data);
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
        $params = $request->all();
        $classroom = Classroom::findOrFail(Crypt::decrypt($id));
        if ($classroom->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/classroom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail(Crypt::decrypt($id));
        if ($classroom->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/classroom');
    }
}
