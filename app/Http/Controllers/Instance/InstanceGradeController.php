<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GradeRequest;
use App\Models\Instance;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InstanceGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::where('instance_id', "=", Auth::user()->instance->id)->get();
        $this->data['grades'] = $grades;
        return view('instance.grade.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::where('instance_id', "=", Auth::user()->instance->id)->get();
        $this->data['student'] = $student;
        return view('instance.grade.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        $params = $request->all();
        $params['instance_id'] = auth()->user()->instance->id;
        $params['teacher_id'] = auth()->user()->instance->teacher_id;
        // Hitung nilai rata-rata
        $nilai1 = $request->input('option_1');
        $nilai2 = $request->input('option_2');
        $nilai3 = $request->input('option_3');
        $nilai4 = $request->input('option_4');
        $nilai5 = $request->input('option_5');

        $rataRata = ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5) / 5;

        $params['ratarata'] = $rataRata;
        if (Grade::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('instance/grade');
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

        $student = Student::where('instance_id', "=", Auth::user()->instance->id)->get();
        $this->data['student'] = $student;
        $grade = Grade::findOrFail(Crypt::decrypt($id));
        $this->data['grades'] = $grade;
        return view('instance.grade.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GradeRequest $request, $id)
    {
        $params1 = $request->all();
        // Hitung nilai rata-rata
        $nilai1 = $request->input('option_1');
        $nilai2 = $request->input('option_2');
        $nilai3 = $request->input('option_3');
        $nilai4 = $request->input('option_4');
        $nilai5 = $request->input('option_5');

        $rataRata = ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5) / 5;

        $params1['ratarata'] = $rataRata;
        $grade = Grade::findOrFail(Crypt::decrypt($id));
        if ($grade->update($params1)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('instance/grade');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail(Crypt::decrypt($id));

        if ($grade->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('instance/grade');
    }
}
