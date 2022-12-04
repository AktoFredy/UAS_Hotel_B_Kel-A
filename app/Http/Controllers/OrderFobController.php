<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderFobResource;
use App\Models\OrderFob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderFobController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        //get order Fob
        $orderFob = OrderFob::latest()->get();

        if(count($orderFob) > 0){
            return new OrderFobResource(true, 'List Data Order Makanan & Minuman', $orderFob);
        }

        return new OrderFobResource(false, 'List Data Order Makanan & Minuman Kosong', $orderFob);
    }

    /**
     * Display spesific Order Fob
     * 
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderFob = OrderFob::findOrfail($id);

        if($orderFob){
            return new OrderFobResource(true, 'Data Order Makanan & Minuman', $orderFob);
        }

        return new OrderFobResource(false, 'Data Order Makanan & Minuman Tidak Ditemukan', $orderFob);;
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
            'id_menu' => 'required',
            'status_pembayaran' => 'required',
            'jumlah' => 'required',
            'total' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        //fungsi create
        $orderFob = OrderFob::create([
            'id_booking' => $request->id_booking,
            'id_menu' => $request->id_menu,
            'status_pembayaran' => $request->status_pembayaran,
            'jumlah' => $request->jumlah,
            'total' => $request->total
        ]);

        return new OrderFobResource(true, 'Order Makanan & Minuman berhasil Ditambah', $orderFob);
    }

    /**
     * update
     * 
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        $orderFob = OrderFob::findOrfail($id);

        if($orderFob){
            $orderFob->update([
                'id_booking' => $request->id_booking,
                'id_menu' => $request->id_menu,
                'status_pembayaran' => $request->status_pembayaran,
                'jumlah' => $request->jumlah,
                'total' => $request->total
            ]);

            return new OrderFobResource(true, 'Order Makanan & Minuman berhasil DiUpdate', $orderFob);
        }

        return new OrderFobResource(false, 'Gagal Update, Order Makanan & Minuman tidak ditemukan', $orderFob);
    }

    public function destroy($id)
    {
        //find
        $orderFob = OrderFob::findOrfail($id);

        if($orderFob){
            //delete
            $orderFob->delete();

            return new OrderFobResource(true, 'Order Makanan & Minuman berhasil DiHapus', $orderFob);
        }

        return new OrderFobResource(false, 'Gagal Hapus, Order Makanan & Minuman  tidak ditemukan', $orderFob);
    }

}
