<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Nette\Utils\DateTime;

class TeacherProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teacher = Teacher::where('user_id',auth()->user()->id)->first();
        $this->data['data'] = $teacher;
        return view('teacher.profile',$this->data);
    }

    public function update(TeacherRequest $request)
    {
        $params = $request->all();

        $request->validate([
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]); 

        if ($request->has('photo')) {
            $params['photo'] = $this->simpanImage('teacher', $request->file('photo'), auth()->user()->username);
        } else {
            $params = $request->except('photo');
        }

        $user = User::findOrFail(Auth::user()->id);
        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                Session::flash('error', 'Data Gagal Disimpan');
            }
        }

        $teacher = teacher::where('user_id',auth()->user()->id)->first();
        if ($teacher->update($params) && $user->save()) {
            Session::flash('success', 'Data Berhasil Disimpan');
        } else {
            Session::flash('error', 'Data Gagal Disimpan');
        }
        return redirect()->route('teacher.profile');
    }

    private function simpanImage($type, $foto, $nama)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/profil/'. $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type. '_'. $nama . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/profil/'. $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
