<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Service;
use Illuminate\Http\Request;
use Exception;

class ServiceController extends Controller
{

    
    public function index(){
        $service = Service::get();
        return view('service.index', compact('service'));
    }

    public function create(){
        $karyawan = Karyawan::get();
        return view('service.create', compact('karyawan'));
    }


    public function store(Request $request){
        $this->validate($request, [
            'nama_service' => 'required',
            'id_karyawan' => 'required',
            'harga_service' => 'required',
            'status_service' => 'required'
        ]);

        try{
            Service::create([
                'nama_service' => $request->nama_service,
                'id_karyawan' => $request->id_karyawan,
                'harga_service' => $request->harga_service,
                'status_service' => $request->status_service
            ]);
            return redirect()->route('service.index')->with(['success' => 'Data service berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('service.index')->with(['success' => 'Data service gagal Disimpan']);
        }
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $karyawan = Karyawan::get();
        return view('service.edit', compact('service','karyawan'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama_service' => 'required',
            'id_karyawan' => 'required',
            'harga_service' => 'required',
            'status_service' => 'required'
        ]);

        try{
            Service::find($id)->update([
                'nama_service' => $request->nama_service,
                'id_karyawan' => $request->id_karyawan,
                'harga_service' => $request->harga_service,
                'status_service' => $request->status_service
            ]);
            return redirect()->route('service.index')->with(['success' => 'Data service berhasil Diedit']);
        }catch(Exception $e){
            return redirect()->route('service.index')->with(['success' => 'Data service gagal Diedit']);
        }
    }

    public function destroy($id)
    {
        try{
            Service::find($id)->delete();            
            return redirect()->route('service.index')->with(['success' => 'Data service berhasil dihapus!']);
        }catch(Exception $e){ 
            return redirect()->route('service.index')->with(['success'=> 'Data service gagal dihapus!']);
        }                
    }
}
