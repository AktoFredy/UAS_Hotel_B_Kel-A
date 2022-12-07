<?php

namespace App\Http\Controllers;

use App\Http\Resources\KamarResource;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{

    
    public function index(){
        $kamar = Kamar::latest()->get();

        if(count($kamar) > 0){
            return new KamarResource(true, 'List Data Kamar Hotel!', $kamar);
        }

        return new KamarResource(false, 'List Data Kamar Hotel Kosong!', $kamar);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kamar = Kamar::findOrfail($id);

        if($kamar){
            return new KamarResource(true, 'Data Kamar Hotel', $kamar);
        }

        return new KamarResource(false, 'Data Kamar Hotel Tidak Ditemukan', $kamar);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'kamar_img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'tipe_kamar' => 'required',
            'harga_sewa' => 'required',
            'kapasitas' => 'required',
            'lantai' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $file = $request->file('kamar_img');
        $image_name = date('Ymd').$file->getClientOriginalName();
        $file->move(public_path('/image'), $image_name);

        $kamar = Kamar::create([
            'kamar_img' => $image_name,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_sewa' => $request->harga_sewa,
            'kapasitas' => $request->kapasitas,
            'lantai' => $request->lantai
        ]);

        return new KamarResource(true, 'Data Kamar Hotel Berhasil Ditambahkan!', $kamar);
    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'kamar_img' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'tipe_kamar' => 'required',
            'harga_sewa' => 'required',
            'kapasitas' => 'required',
            'lantai' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('kamar_img');
        $image_name = date('Ymd').$file->getClientOriginalName();
        $file->move(public_path('/image'), $image_name);

        $kamar = Kamar::findOrfail($id);

        $path = "image/".$kamar['kamar_img'];

        if($kamar){
            $kamar->update([
                'kamar_img' => $image_name,
                'tipe_kamar' => $request->tipe_kamar,
                'harga_sewa' => $request->harga_sewa,
                'kapasitas' => $request->kapasitas,
                'lantai' => $request->lantai
            ]);

            unlink($path);

            return new KamarResource(true, 'Data Kamar Hotel Berhasil DiUpdate!', $kamar);
        }         

        return new KamarResource(false, 'Gagal Update, Data Kamar Hotel Tidak Ditemukan!', $kamar);
    }

    public function destroy($id){
        $kamar = Kamar::findOrfail($id);
        $path = "image/".$kamar['kamar_img'];

        if($kamar){
            $kamar->delete();
            unlink($path);

            return new KamarResource(true, 'Data Kamar Hotel Berhasil DiHapus!', $kamar);
        }

        return new KamarResource(false, 'Gagal Hapus, Data Kamar Hotel Tidak Ditemukan!', $kamar);
    }
}
