<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DownloadReportController extends Controller
{
    public function download(Request $request,$file)
    {
        return response()->download(public_path('storage/report/'.$file));
        // $data = Report::where('id',$id)->first();
        // $filepath = storage_path("report/{$data->file}");
        // return response()::download($filepath);
    }
}
