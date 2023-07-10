<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class DownloadReportController extends Controller
{
    public function download(Request $request,$file)
    {
        return response()->download(storage_path('app/public/public/report/' . $file));
        // $data = Report::where('id',$id)->first();
        // $filepath = storage_path("report/{$data->file}");
        // return response()::download($filepath);
    }
}
