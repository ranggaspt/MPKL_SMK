<?php

namespace App\Http\Controllers\Instance;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class InstanceJournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('instance_id',"=",Auth::user()->instance->id)->get();
        $this->data['journal'] = $journals;
        return view('instance.journal.validation', $this->data);
    }

    public function terima($id)
    {
        // dd('1');
        $params['validation_jurnal'] = 'terima';
        $journal = Journal::findOrFail(Crypt::decrypt($id));
        // $user = User::findOrFail($journal->user_id);
        if ($journal->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        }else{
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('instance/journal');
    }
    
    public function tolak($id)
    {
        $params['validation_jurnal'] = 'tolak';
        $journal = Journal::findOrFail(Crypt::decrypt($id));
        // $user = User::findOrFail($journal->user_id);
        if ($journal->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        }else{
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('instance/journal');
    }

}
