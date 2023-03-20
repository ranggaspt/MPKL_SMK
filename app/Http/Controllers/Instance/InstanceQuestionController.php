<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class InstanceQuestionController extends Controller
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
        $package_id = Session::get('package_id');
        $questions = Question::where('package_id', $package_id)->orderBy('id', 'ASC');
        $questions = Question::all();
        $this->data['questions'] = $questions;
        return view('instance.question.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instance.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $params = $request->all();
        $params['package_id'] = Session::get('package_id');;
        if (Question::create($params)) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }
        return redirect('instance/question');
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
        $question = Question::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $question;
        return view('instance.question.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $params = $request->all();
        $question = Question::findOrFail(Crypt::decrypt($id));
        if ($question->update($params)) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }
        return redirect('instance/question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail(Crypt::decrypt($id));
        if ($question->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('instance/question');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('images/ckeditor'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/ckeditor' . $fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
