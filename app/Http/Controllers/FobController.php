<?php

namespace App\Http\Controllers;

use App\Http\Resources\FobResource;
use App\Models\Fob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FobController extends Controller
{
    
    public function index(){
        $fob = Fob::latest()->get();

        if(count($fob) > 0){
            return new FobResource(true, 'List Food And Beaverage!', $fob);
        }
        
        return new FobResource(false, 'List Food And Beaverage Kosong!', $fob);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fob = Fob::findOrfail($id);

        if($fob){
            return new FobResource(true, 'Data Makanan & Minuman Hotel', $fob);
        }

        return new FobResource(false, 'Data Booking Hotel Tidak Ditemukan', $fob);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'jenis_menu' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $fob = Fob::create([
            'nama_menu' => $request->nama_menu,
            'jenis_menu' => $request->jenis_menu,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        return new FobResource(true, 'Data Makanan dan Minuman berhasil Ditambah!', $fob);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'jenis_menu' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $fob = Fob::findOrfail($id);

        if($fob){
            $fob->update([
                'nama_menu' => $request->nama_menu,
                'jenis_menu' => $request->jenis_menu,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]);

            return new FobResource(true, 'Data Makanan dan Minuman berhasil DiUpdate!', $fob);
        }                

        return new FobResource(false, 'Gagal Update, Data Makanan dan Minuman Tidak Ditemukan!', $fob);
    }

    public function destroy($id)
    {
        $fob = Fob::findOrfail($id);
        
        if($fob){
            $fob->delete();

            return new FobResource(true, 'Data Makanan dan Minuman berhasil DiHapus!', $fob);
        }

        return new FobResource(false, 'Gagal Hapus, Data Makanan dan Minuman Tidak Ditemukan!', $fob);
    }

}
