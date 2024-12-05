<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Fungsi tambah Siswa
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'id_buku' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $save = User::create([
            'nama' => $req->get('nama'),
            'id_buku' => $req->get('id_buku'),
            'no_tlp' => $req->get('no_tlp'),
            'alamat' => $req->get('alamat'),
            'role' => $req->get('role'),
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Sukses menambahkan user']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambahkan user']);
        }
    }

    //Fugsi tampil siswa
    public function index()
    {
        $user = User::with('buku')->get(); // 'kelas' adalah relasi ke model Kelas
        return response()->json($user);
    }

    // Fungsi mendapatkan detail siswa berdasarkan ID
    public function getUserById($id)
    {
        $user = User::find($id);


        if ($user) {
            return response()->json(['status' => true, 'data' => $user]);
        } else {
            return response()->json(['status' => false, 'message' => 'User tidak ditemukan']);
        }
    }

    // Fungsi update siswa
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'id_buku' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $ubah = User::where('id', $id)->update([
            'nama' => $req->get('nama'),
            'id_buku' => $req->get('id_buku'),
            'no_tlp' => $req->get('no_tlp'),
            'alamat' => $req->get('alamat'),
            'role' => $req->get('role'),
        ]);

        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'Sukses update user']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal mengupdate user']);
        }
    }
    // Fungsi menghapus siswa
    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['status' => true, 'message' => 'User berhasil dihapus']);
        } else {
            return response()->json(['status' => false, 'message' => 'User tidak ditemukan']);
        }
    }
}