<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportsResource;
use App\Models\Report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RepotsApiController extends Controller
{
    public function index()
    {
        //get posts
        $report = Report::latest()->paginate(5);

        //return collection of report as a resource
        return new ReportsResource(true, 'List Data Report', $report);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
            'description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $file = $request->file('file');
        $file->storeAs('public/report', $file->hashName());

        //create post
        $report = Report::create([
            'file' => $file->hashName(),
            'description' => $request->description,
        ]);

        //return response
        return new ReportsResource(true, 'Data laporan magang Berhasil Ditambahkan!', $report);
    }
}
