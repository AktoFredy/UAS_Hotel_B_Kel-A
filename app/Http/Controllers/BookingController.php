<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Karyawan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        $booking = Booking::get();
        return view('booking.index', compact('booking'));
    }

    public function create(){
        $user = User::get();
        $kamar = Kamar::get();
        $karyawan = Karyawan::get();
        return view('booking.create', compact('user', 'kamar', 'karyawan'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_user' => 'required',
            'id_kamar' => 'required',
            'lama_menginap' => 'required',
            'status_pembayaran' => 'required',
            'stat_cekInOrOut' => 'required',
            'id_karyawan' => 'required'
        ]);

        try{
            Booking::create([
                'id_user' => $request->id_user,
                'id_kamar' => $request->id_kamar,
                'lama_menginap' => $request->lama_menginap,
                'status_pembayaran' => $request->status_pembayaran,
                'stat_cekInOrOut' => $request->stat_cekInOrOut,
                'id_karyawan' => $request->id_karyawan
            ]);
            return redirect()->route('booking.index')->with(['success' => 'Data booking berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('booking.index')->with(['success' => 'Data booking gagal Disimpan']);
        }
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        $user = User::get();
        $kamar = Kamar::get();
        $karyawan = Karyawan::get();
        return view('booking.edit', compact('user','kamar', 'karyawan','booking'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'id_user' => 'required',
            'id_kamar' => 'required',
            'lama_menginap' => 'required',
            'status_pembayaran' => 'required',
            'stat_cekInOrOut' => 'required',
            'id_karyawan' => 'required'
        ]);

        try{
            Booking::find($id)->update([
                'id_user' => $request->id_user,
                'id_kamar' => $request->id_kamar,
                'lama_menginap' => $request->lama_menginap,
                'status_pembayaran' => $request->status_pembayaran,
                'stat_cekInOrOut' => $request->stat_cekInOrOut,
                'id_karyawan' => $request->id_karyawan
            ]);
            return redirect()->route('booking.index')->with(['success' => 'Data booking berhasil Diedit']);
        }catch(Exception $e){
            return redirect()->route('booking.index')->with(['success' => 'Data booking gagal Diedit']);
        }
    }

    public function destroy($id)
    {
        try{
            Booking::find($id)->delete();            
            return redirect()->route('booking.index')->with(['success' => 'Data  booking berhasil dihapus!']);
        }catch(Exception $e){ 
            return redirect()->route('booking.index')->with(['success'=> 'Data booking gagal dihapus!']);
        }                
    }
}
