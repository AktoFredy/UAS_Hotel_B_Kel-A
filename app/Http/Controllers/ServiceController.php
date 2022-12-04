<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    public function index(){
        $service = Service::latest()->get();

        if(count($service) > 0){
            return new ServiceResource(true, 'List Data Service Hotel', $service);
        }

        return new ServiceResource(false, 'List Data Service Hotel Kosong', $service);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrfail($id);

        if($service){
            return new ServiceResource(true, 'Data Service Hotel', $service);
        }

        return new ServiceResource(false, 'Data Service Hotel Tidak Ditemukan', $service);;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_service' => 'required',
            'id_karyawan' => 'required',
            'harga_service' => 'required',
            'status_service' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $service = Service::create([
            'nama_service' => $request->nama_service,
            'id_karyawan' => $request->id_karyawan,
            'harga_service' => $request->harga_service,
            'status_service' => $request->status_service
        ]);    

        return new ServiceResource(true, 'Data Service Hotel berhasil Ditambahkan', $service);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_service' => 'required',
            'id_karyawan' => 'required',
            'harga_service' => 'required',
            'status_service' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $service = Service::findOrfail($id);

        if($service){
            $service->update([
                'nama_service' => $request->nama_service,
                'id_karyawan' => $request->id_karyawan,
                'harga_service' => $request->harga_service,
                'status_service' => $request->status_service
            ]); 
            
            return new ServiceResource(true, 'Data Service Hotel Berhasil DiUpdate', $service);
        }

        return new ServiceResource(false, 'Gagal Update, Data Service Hotel tidak ditemukan', $service);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if($service){
            $service->delete();

            return new ServiceResource(true, 'Data Service Hotel Berhasil DiHapus', $service);
        }
        
        return new ServiceResource(false, 'Gagal Hapus, Data Service Hotel tidak ditemukan', $service);           
    }
}
