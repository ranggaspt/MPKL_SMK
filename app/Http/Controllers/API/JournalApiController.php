<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JournalResource;
use App\Models\Journal;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JournalApiController extends Controller
{
    public function index()
    {
        //get posts
        $journal = Journal::latest()->paginate(5);

        //return collection of journal as a resource
        return new JournalResource(true, 'List Data Journal', $journal);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'photo' => 'nullabel|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'list_jurnals' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $photo = $request->file('photo');
        $photo->storeAs('public/posts', $photo->hashName());

        //create post
        $student = Student::where('id', Auth::user()->student->id)
            ->first();
        if ( $student == null) {
            $journal = Journal::create([
                'photo' => $photo->hashName(),
                'list_jurnals' => $request->list_jurnals,
                'student_id' => $student->id,
                'instance_id' => $student->instance_id,
                'teacher_id' => $student->teacher_id,
            ]);
        }


        //return response
        return new JournalResource(true, 'Data journal Berhasil Ditambahkan!', $journal);
    }
}
