<?php

namespace App\Http\Controllers\Instance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Instance;
use App\Models\Package;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Nette\Utils\DateTime;

class InstancePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::where('instance_id', auth()->user()->instance->id)->get();
        $this->data['packages'] = $packages;
        $date = new DateTime();
        $timeNow = $date->format('Y-m-d\TH:i');
        $this->data['time'] = $timeNow;
        return view('instance.package.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('instance.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $params = $request->all();
        if ($request->has('photo')) {
            $params['photo'] = $this->simpanImage('package', $request->file('photo'), $params['name']);
        }
        $params['instance_id']=auth()->user()->instance->id;
        if (Package::create($params)) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }

        return redirect('instance/package');
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
        
        $package =Package::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $package;
        return view('instance.package.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        $params = $request->all();
        $params['instance_id']=auth()->user()->instance->id;
        if ($request->has('photo')) {
            $params['photo'] = $this->simpanImage('package', $request->file('photo'), $params['name']);
        } else {
            $params = $request->except('photo');
        }
        $package = Package::findOrFail(Crypt::decrypt($id));
        if ($package->update($params)) {
            alert()->success('Success','Data Berhasil Disimpan');
        } else {
            alert()->error('Error','Data Gagal Disimpan');
        }
        return redirect('instance/package');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail(Crypt::decrypt($id));
        $url = $package->photo;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($package->delete()) {
            alert()->success('Success','Data Berhasil Dihapus');
        }
        return redirect('instance/package');
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
