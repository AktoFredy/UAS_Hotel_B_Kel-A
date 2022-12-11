<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaketWisataResource;
use Illuminate\Http\Request;
use App\Models\paket_wisata;
use Illuminate\Support\Facades\Validator;

class PaketWisata extends Controller
{
    public function index(){
        $paket_wisata = paket_wisata::latest()->get();

        if(count($paket_wisata) > 0){
            return new PaketWisataResource(true, 'List Data Paket Liburan', $paket_wisata);
        }

        return new PaketWisataResource(false, 'List Data Paket Liburan Kosong', $paket_wisata);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket_wisata = paket_wisata::findOrfail($id);

        if($paket_wisata){
            return new PaketWisataResource(true, 'Data Paket Liburan', $paket_wisata);
        }

        return new PaketWisataResource(false, 'Data Paket Liburan Tidak Ditemukan', $paket_wisata);;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'required',
            'alamat' => 'required',
            'harga' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $paket_wisata = paket_wisata::create([
            'nama_wisata' => $request->nama_wisata,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
        ]);    

        return new PaketWisataResource(true, 'Data Paket Liburan berhasil Ditambahkan', $paket_wisata);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'required',
            'alamat' => 'required',
            'harga' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $paket_wisata = paket_wisata::findOrfail($id);

        if($paket_wisata){
            $paket_wisata->update([
                'nama_wisata' => $request->nama_wisata,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
            ]); 
            
            return new PaketWisataResource(true, 'Data Paket Liburan Berhasil DiUpdate', $paket_wisata);
        }

        return new PaketWisataResource(false, 'Gagal Update, Data Paket Liburan tidak ditemukan', $paket_wisata);
    }

    public function destroy($id)
    {
        $paket_wisata = paket_wisata::findOrFail($id);

        if($paket_wisata){
            $paket_wisata->delete();

            return new PaketWisataResource(true, 'Data Paket Liburan Berhasil DiHapus', $paket_wisata);
        }
        
        return new PaketWisataResource(false, 'Gagal Hapus, Data Paket Liburan tidak ditemukan', $paket_wisata);           
    }
}
