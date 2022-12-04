<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Exception;

class KaryawanController extends Controller
{
    
    public function index(){
        $karyawan = Karyawan::get();

        return view('karyawan.index', compact('karyawan'));
    }

    
    public function create(){
        return view('karyawan.create');
    }

    

    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required',
            'noHp' => 'required|regex:/^08([0-9]{4,5}$)/i',
            'alamat' => 'required',
            'email' => 'required|email',
            'gaji' => 'required',
            'status' => 'required'
        ]);

        try{
            Karyawan::create([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'umur' => $request->umur,
                'noHp' => $request->noHp,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'gaji' => $request->gaji,
                'status' => $request->status
            ]);
            return redirect()->route('karyawan.index')->with(['success' => 'Data karyawan berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('karyawan.index')->with(['success' => 'Data karyawan gagal Disimpan']);
        }

        

    }

    public function edit($id){
        $karyawan = Karyawan::find($id);
        return view('karyawan.edit', compact('karyawan'));  
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required',
            'noHp' => 'required|regex:/^08([0-9]{4,5}$)/i',
            'alamat' => 'required',
            'email' => 'required|email',
            'gaji' => 'required',
            'status' => 'required'
        ]);

        try{
            Karyawan::find($id)->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'umur' => $request->umur,
                'noHp' => $request->noHp,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'gaji' => $request->gaji,
                'status' => $request->status
            ]);
            return redirect()->route('karyawan.index')->with(['success' => 'Data karyawan berhasil Diedit']);
        }catch(Exception $e){
            return redirect()->route('karyawan.index')->with(['success' => 'Data karyawan gagal Diedit']);
        }
    }
}
