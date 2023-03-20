<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\DateTime;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        $this->data['teachers'] = $teachers;
        return view('admin.teacher.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest  $request1, UserRequest $request2)
    {
        $params1 = $request1->all();
        $params2 = [
            'username' => $request2->username,
            'password' => Hash::make($request2->password),
            'role' => 'teacher'
        ];
        if ($request1->has('photo')) {
            $params1['photo'] = $this->simpanImage('teacher', $request1->file('photo'), $params2['username']);
        }
        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;
            if (Teacher::create($params1)) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user = User::findOrFail($user->id);
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect('admin/teacher');
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
        $teacher = Teacher::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $teacher;
        return view('admin.teacher.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest  $request1, UserRequest $request2, $id)
    {
        $params1 = $request1->all();
        $params2['username'] = $request2->username;

        if ($request2->filled('password')) {
            $params2['password'] = Hash::make($request2->password);
        } else {
            $params2 = $request2->except('password');
        }

        if ($request1->has('photo')) {
            $params1['photo'] = $this->simpanImage('teacher', $request1->file('photo'), $params2['username']);
        } else {
            $params1 = $request1->except('photo');
        }

        $teacher = Teacher::findOrFail(Crypt::decrypt($id));
        $user = User::findOrFail($teacher->user_id);
        if ($teacher->update($params1) && $user->update($params2)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail(Crypt::decrypt($id));
        $url = $teacher->photo;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($teacher->delete()) {
            $user = User::findOrFail($teacher->user_id);
            $user->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/teacher');
    }

    private function simpanImage($type, $foto, $nama)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '_' . $nama . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
