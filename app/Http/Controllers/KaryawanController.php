<?php

namespace App\Http\Controllers;

use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    
    public function index(){
        $karyawan = Karyawan::latest()->get();

        if(count($karyawan) > 0){
            return new KaryawanResource(true, 'List Data Karyawan Hotel!', $karyawan);
        }

        return new KaryawanResource(false, 'List Data Karyawan Hotel Kosong!', $karyawan);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::findOrfail($id);

        if($karyawan){
            return new KaryawanResource(true, 'Data Karyawan Hotel', $karyawan);
        }

        return new KaryawanResource(false, 'Data Karyawan Hotel Tidak Ditemukan', $karyawan);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required',
            'noHp' => 'required|regex:/^08([0-9]{4,5}$)/i',
            'alamat' => 'required',
            'email' => 'required|email',
            'gaji' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $karyawan = Karyawan::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'umur' => $request->umur,
            'noHp' => $request->noHp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'gaji' => $request->gaji,
            'status' => $request->status
        ]);


        return new KaryawanResource(true, 'Data Karyawan Hotel Behasil Ditambah', $karyawan);     

    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'umur' => 'required',
            'noHp' => 'required|regex:/^08([0-9]{4,5}$)/i',
            'alamat' => 'required',
            'email' => 'required|email',
            'gaji' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $karyawan = Karyawan::findOrfail($id);

        if($karyawan){
            $karyawan->update([
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'umur' => $request->umur,
                'noHp' => $request->noHp,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'gaji' => $request->gaji,
                'status' => $request->status
            ]);

            return new KaryawanResource(true, 'Data Karyawan Hotel Behasil DiUpdate', $karyawan);
        }
            
        return new KaryawanResource(true, 'Gagal Update, Data Karyawan Hotel tidak Ditemukan', $karyawan);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrfail($id);
        
        if($karyawan){
            $karyawan->delete();

            return new KaryawanResource(true, 'Data Karyawan Hotel Behasil DiHapus', $karyawan);
        }

        return new KaryawanResource(true, 'Gagal Hapus, Data Karyawan Hotel tidak Ditemukan', $karyawan);
    }
}
