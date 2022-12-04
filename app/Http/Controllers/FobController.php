<?php

namespace App\Http\Controllers;

use App\Models\Fob;
use Illuminate\Http\Request;
use Exception;
class FobController extends Controller
{
    
    public function index(){
        $fob = Fob::get();

        return view('fob.index', compact('fob'));
    }

    
    public function create(){
        return view('fob.create');
    }

    
    public function store(Request $request){
        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_menu' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        try{
            Fob::create([
                'nama_menu' => $request->nama_menu,
                'jenis_menu' => $request->jenis_menu,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]);
            return redirect()->route('fob.index')->with(['success' => 'Data Food and Beaverage berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('fob.index')->with(['success' => 'Data Food and Beaverage gagal Disimpan']);
        }
    }

    public function edit($id){
        $fob = Fob::find($id);
        return view('fob.edit', compact('fob'));
            
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_menu' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        try{
            Fob::find($id)->update([
                'nama_menu' => $request->nama_menu,
                'jenis_menu' => $request->jenis_menu,
                'harga' => $request->harga,
                'stok' => $request->stok
            ]);
            return redirect()->route('fob.index')->with(['success' => 'Data Food and Beaverage berhasil Diedit']);
        }catch(Exception $e){
            return redirect()->route('fob.index')->with(['success' => 'Data Food and Beaverage gagal Diedit']);
        }
    }

    public function destroy($id)
    {
        try{
            Fob::find($id)->delete();            
            return redirect()->route('fob.index')->with(['success' => 'Data Food and Beaverage berhasil dihapus!']);
        }catch(Exception $e){ 
            return redirect()->route('fob.index')->with(['success'=> 'Data Food and Beaverage gagal dihapus!']);
        }                
    }

}
