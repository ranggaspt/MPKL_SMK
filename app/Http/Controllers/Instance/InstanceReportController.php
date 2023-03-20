<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Instance;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Nette\Utils\DateTime;

class InstanceReportController extends Controller
{
    public function index()
    {
        $instance = Instance::where('user_id',auth()->user()->id)->first();
        $packages = Package::where('instance_id',$instance->id)->orderBy('name', 'ASC');
        $this->data['packages'] = $packages->paginate(10);
        $date = new DateTime();
        $timeNow = $date->format('Y-m-d\TH:i');
        $this->data['time'] = $timeNow;
        return view('instance.report.index', $this->data);
    }

    public function reportParticipant($id){
        $package = Package::findOrFail(Crypt::decrypt($id));
        $exams = Exam::with('participants')->where('package_id',$package->id)->orderBy('name', 'ASC');
        $this->data['exams'] = $exams->paginate(10);
        return view('instance.report.participant', $this->data);
    }
}
