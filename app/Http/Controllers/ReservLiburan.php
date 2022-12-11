<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservLiburanResource;
use App\Models\orwis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservLiburan extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        //get order Fob
        $order_wisata = orwis::latest()->get();

        if(count($order_wisata) > 0){
            return new ReservLiburanResource(true, 'List Data Reservasi Paket Wisata', $order_wisata);
        }

        return new ReservLiburanResource(false, 'List Data Reservasi Paket Wisata Kosong', $order_wisata);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_wisata = orwis::findOrfail($id);

        if($order_wisata){
            return new ReservLiburanResource(true, 'Data Reservasi Paket Wisata', $order_wisata);
        }

        return new ReservLiburanResource(false, 'Data Reservasi Paket Wisata Tidak Ditemukan', $order_wisata);;
    }

    /**
     * store
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_booking' => 'required',
            'id_wisata' => 'required',
            'status_pembayaran' => 'required',
            'supir' => 'required',
            'kendaraan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        //fungsi create
        $order_wisata = orwis::create([
            'id_booking' => $request->id_booking,
            'id_wisata' => $request->id_wisata,
            'status_pembayaran' => $request->status_pembayaran,
            'supir' => $request->supir,
            'kendaraan' => $request->kendaraan
        ]);

        return new ReservLiburanResource(true, 'Reservasi Paket Wisata berhasil Ditambah', $order_wisata);
    }

    /**
     * update
     * 
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'id_booking' => 'required',
            'id_wisata' => 'required',
            'status_pembayaran' => 'required',
            'supir' => 'required',
            'kendaraan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $order_wisata = orwis::findOrfail($id);

        if($order_wisata){
            $order_wisata->update([
                'id_booking' => $request->id_booking,
                'id_wisata' => $request->id_wisata,
                'status_pembayaran' => $request->status_pembayaran,
                'supir' => $request->supir,
                'kendaraan' => $request->kendaraan
            ]);

            return new ReservLiburanResource(true, 'Reservasi Paket Wisata berhasil DiUpdate', $order_wisata);
        }

        return new ReservLiburanResource(false, 'Gagal Update, Reservasi Paket Wisata tidak ditemukan', $order_wisata);
    }

    public function destroy($id)
    {
        //find
        $order_wisata = orwis::findOrfail($id);

        if($order_wisata){
            //delete
            $order_wisata->delete();

            return new ReservLiburanResource(true, 'Reservasi Paket Wisata berhasil DiHapus', $order_wisata);
        }

        return new ReservLiburanResource(false, 'Gagal Hapus, Reservasi Paket Wisata tidak ditemukan', $order_wisata);
    }
}
