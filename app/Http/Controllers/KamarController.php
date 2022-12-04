<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Exception;
class KamarController extends Controller
{

    
    public function index(){
        $kamar = Kamar::get();

        return view('kamar.index', compact('kamar'));
    }

    
    public function create(){
        return view('kamar.create');
    }


    public function store(Request $request){
        $this->validate($request, [
            'tipe_kamar' => 'required',
            'harga_sewa' => 'required',
            'kapasitas' => 'required',
            'lantai' => 'required'
        ]);

        try{
            Kamar::create([
                'tipe_kamar' => $request->tipe_kamar,
                'harga_sewa' => $request->harga_sewa,
                'kapasitas' => $request->kapasitas,
                'lantai' => $request->lantai
            ]);
            return redirect()->route('kamar.index')->with(['success' => 'Data kamar berhasil Disimpan']);
        }catch(Exception $e){
            return redirect()->route('kamar.index')->with(['success' => 'Data kamar gagal Disimpan']);
        }
    }

    public function edit($id){
        $kamar = Kamar::find($id);
        return view('kamar.edit', compact('kamar'));
            
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'tipe_kamar' => 'required',
            'harga_sewa' => 'required',
            'kapasitas' => 'required',
            'lantai' => 'required'
        ]);

        try{
            Kamar::find($id)->update([
                'tipe_kamar' => $request->tipe_kamar,
                'harga_sewa' => $request->harga_sewa,
                'kapasitas' => $request->kapasitas,
                'lantai' => $request->lantai
            ]);
            return redirect()->route('kamar.index')->with(['success' => 'Data kamar berhasil Diedit']);
        }catch(Exception $e){
            return redirect()->route('kamar.index')->with(['success' => 'Data kamar gagal Diedit']);
        }
    }

    public function destroy($id){
        try{
           Kamar::find($id)->delete();             
           return redirect()->route('kamar.index')->with(['success' => 'Data kamar berhasil dihapus!']);
       }catch(Exception $e){
            return redirect()->route('kamar.index')->with(['success'=> 'Data kamar gagal dihapus!']);
        } 
     }



}
