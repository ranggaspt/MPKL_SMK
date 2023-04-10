<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Instance;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\DateTime;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $this->data['students'] = $students;
        return view('admin.student.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::orderBy('name', 'ASC')->get();
        $this->data['classrooms'] = $classrooms;
        $instances = Instance::orderBy('name', 'ASC')->get();
        $this->data['instances'] = $instances;
        return view('admin.student.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request1, UserRequest $request2)
    {
        $params1 = $request1->all();
        $params2 = [
            'username' => $request2->username,
            'password' => Hash::make($request2->password),
            'role' => 'student'
        ];
        if ($request1->has('photo')) {
            $params1['photo'] = $this->simpanImage('student', $request1->file('photo'), $params2['username']);
        }
        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;
            if (Student::create($params1)) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user = User::findOrFail($user->id);
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect('admin/student');
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
        $classrooms = Classroom::orderBy('name', 'ASC')->get();
        $this->data['classrooms'] = $classrooms;
        $instances = Instance::orderBy('name', 'ASC')->get();
        $this->data['instances'] = $instances;
        $student = Student::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $student;
        return view('admin.student.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request1, UserRequest $request2, $id)
    {
        $params1 = $request1->all();
        $params2['username'] = $request2->username;

        if ($request2->filled('password')) {
            $params2['password'] = Hash::make($request2->password);
        } else {
            $params2 = $request2->except('password');
        }

        if ($request1->has('photo')) {
            $params1['photo'] = $this->simpanImage('student', $request1->file('photo'), $params2['username']);
        } else {
            $params1 = $request1->except('photo');
        }

        $student = Student::findOrFail(Crypt::decrypt($id));
        $user = User::findOrFail($student->user_id);
        if ($student->update($params1) && $user->update($params2)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail(Crypt::decrypt($id));
        $url = $student->photo;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($student->delete()) {
            $user = User::findOrFail($student->user_id);
            $user->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/student');
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

    // public function getStudent()
    // {
    //     $students = Student::where('instance_id',"=",Auth::user()->instance->id)->get();
    //     $this->data['students'] = $students;
    //     return view('instance.student.member', $this->data);
    // }

    

    // public function format() 
    // {
    //     Excel::download(new ParticipantExport, 'peserta.xlsx');
    //     return redirect('admin/participant');
    // }

    // public function import() 
    // {
    //     Excel::import(new UsersImport,request()->file('file'));
    //     Excel::import(new ParticipantImport,request()->file('file'));
    //     return back();
    // }
}
