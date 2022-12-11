<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Bool_;

class BookingController extends Controller
{
    public function index(){
        $booking = Booking::latest()->get();

        if(count($booking) > 0){
            return new BookingResource(true, 'List Data Booking', $booking);
        }

        return new BookingResource(false, 'List Data Booking Kosong', $booking);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_kamar' => 'required',
            'lama_menginap' => 'required',
            'status_pembayaran' => 'required',
            'stat_cekInOrOut' => 'required',
            'id_karyawan' => 'required' //kasir nya, jadi relasi karyawan dengan jabatan kasir
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $booking = Booking::create([
            'id_user' => $request->id_user,
            'id_kamar' => $request->id_kamar,
            'lama_menginap' => $request->lama_menginap,
            'status_pembayaran' => $request->status_pembayaran,
            'stat_cekInOrOut' => $request->stat_cekInOrOut,
            'id_karyawan' => $request->id_karyawan
        ]);

        return new BookingResource(true, 'Data Booking Berhasil Ditambah!', $booking);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrfail($id);

        if($booking){
            return new BookingResource(true, 'Data Booking Hotel', $booking);
        }

        return new BookingResource(false, 'Data Booking Hotel Tidak Ditemukan', $booking);
    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'id_kamar' => 'required',
            'lama_menginap' => 'required',
            'status_pembayaran' => 'required',
            'stat_cekInOrOut' => 'required',
            'id_karyawan' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $booking = Booking::findOrfail($id);

        if($booking){
            $booking->update([
                'id_user' => $request->id_user,
                'id_kamar' => $request->id_kamar,
                'lama_menginap' => $request->lama_menginap,
                'status_pembayaran' => $request->status_pembayaran,
                'stat_cekInOrOut' => $request->stat_cekInOrOut,
                'id_karyawan' => $request->id_karyawan
            ]);

            return new BookingResource(true, 'Data Booking Berhasil Di Update!', $booking);
        }

        return new BookingResource(false, 'Gagal Update, Data Booking Tidak Ditemukan!', $booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrfail($id);
        
        if($booking){
            $booking->delete();

            return new BookingResource(true, 'Data Booking Berhasil Di Hapus!', $booking);
        }

        return new BookingResource(false, 'Gagal Hapus, Data Booking Tidak Ditemukan!', $booking);
    }
}
