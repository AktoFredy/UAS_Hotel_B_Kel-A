<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderServiceResource;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderServiceController extends Controller
{
    
    public function index(){
        $orderService = OrderService::latest()->get();

        if(count($orderService)){
            return new OrderServiceResource(true, 'List Data Order Service', $orderService);
        }

        return new OrderServiceResource(false, 'List Data Order Service Kosong', $orderService);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderService = OrderService::findOrfail($id);

        if($orderService){
            return new OrderServiceResource(true, 'Data Order Service Hotel', $orderService);
        }

        return new OrderServiceResource(false, 'Data Order Service Hotel Tidak Ditemukan', $orderService);;
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_booking' => 'required',
            'id_service' => 'required',
            'status_pembayaran' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $orderService = OrderService::create([
            'id_booking' => $request->id_booking,
            'id_service' => $request->id_service,
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return new OrderServiceResource(true, 'Order Service Hotel Berhasil Ditambahkan', $orderService);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id_booking' => 'required',
            'id_service' => 'required',
            'status_pembayaran' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $orderService = OrderService::findOrfail($id);

        if($orderService){
            $orderService->update([
                'id_booking' => $request->id_booking,
                'id_service' => $request->id_service,
                'status_pembayaran' => $request->status_pembayaran
            ]);

            return new OrderServiceResource(true, 'Order Service Berhasil DiUpdate', $orderService);
        }

        return new OrderServiceResource(false, 'Gagal Update, Order Service Hotel tidak ditemukan', $orderService);        
    }

    public function destroy($id)
    {
        $orderService = OrderService::findOrfail($id);
        
        if($orderService){
            $orderService->delete();

            return new OrderServiceResource(true, 'Order Service Berhasil DiHapus', $orderService); 
        }
            
        return new OrderServiceResource(false, 'Gagal Hapus, Order Service Hotel tidak ditemukan', $orderService);          
    }
}
