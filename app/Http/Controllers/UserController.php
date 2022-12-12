<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\teleponVad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();

        if(count($users) > 0){
            return new UserResource(true, 'List data Users', $users);
        }

        return new UserResource(false, 'List Data User Kosong', $users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);

        if($user){
            return new UserResource(true, 'Data User', $user);
        }

        return new UserResource(false, 'Data User Tidak Ditemukan', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|alpha_num',
            'email' => 'required|unique:users|email:rfc',
            'password' => 'required',
            'nama' => 'required|string|max:60',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'alamat' => 'required',
            'no_hp' => [new teleponVad()],
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::findOrfail($id);

        if($user){
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama' => $request->nama,
                'umur' => $request->umur,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'status' => $request->status
            ]);

            return new UserResource(true, 'Data User Berhasil DiUpdate', $user);
        }

        // $updateData = $request->all();
        // $validate = Validator::make($updateData, [
        //     'name' => ['required', 'max:60', Rule::unique('users')->ignore($user)],
        //     'email' => 'required|email:rfc,dns|unique:users',
        //     'password' => 'required',
        //     'username' => 'required|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{6,12}$/' // TUGAS validasi username
        // ]);

        // if($validate->fails())
        //     return response(['message' => $validate->errors()], 400);
        
        // $updateData['password'] = bcrypt($request->password);
        
        // $user->name = $updateData['name'];
        // $user->email = $updateData['email'];
        // $user->password = $updateData['password'];
        // $user->username = $updateData['username'];

        

        return new UserResource(false, 'Gagal Update, Data User tidak ditemukan', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);

        if($user){
            $user->delete();

            return new UserResource(true, 'Data User Berhasil DiUpdate', $user);
        }

        return new UserResource(false, 'Gagal Hapus, Data User tidak ditemukan', $user);
    }
}
