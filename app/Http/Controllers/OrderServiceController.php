<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\OrderService;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    
    public function index(){
        $orderService = OrderService::get();
        return view('orderService.index', compact('orderService'));
    }

    public function create(){
        $booking = Booking::get();
        $service = Service::get();
        return view('orderService.create', compact('booking', 'service'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_booking' => 'required',
            'id_service' => 'required',
            'status_pembayaran' => 'required'
        ]);

        try{
            OrderService::create([
                'id_booking' => $request->id_booking,
                'id_service' => $request->id_service,
                'status_pembayaran' => $request->status_pembayaran
            ]);
            return redirect()->route('orderService.index')->with(['success' => 'Data order service berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('orderService.index')->with(['success' => 'Data order service gagal Disimpan']);
        }
    }

    public function edit($id)
    {
        $orderService = OrderService::find($id);
        $booking = Booking::get();
        $service = Service::get();
        return view('orderservice.edit', compact('booking','service','orderService'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'id_booking' => 'required',
            'id_service' => 'required',
            'status_pembayaran' => 'required'
        ]);

        try{
            OrderService::find($id)->update([
                'id_booking' => $request->id_booking,
                'id_service' => $request->id_service,
                'status_pembayaran' => $request->status_pembayaran
            ]);
            return redirect()->route('orderService.index')->with(['success' => 'Data order service berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('orderService.index')->with(['success' => 'Data order service gagal Disimpan']);
        }
    }

    public function destroy($id)
    {
        try{
            OrderService::find($id)->delete();            
            return redirect()->route('orderService.index')->with(['success' => 'Data  order service berhasil dihapus!']);
        }catch(Exception $e){ 
            return redirect()->route('orderService.index')->with(['success'=> 'Data  order service gagal dihapus!']);
        }                
    }
}
