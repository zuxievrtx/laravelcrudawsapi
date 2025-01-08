<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    // Get semua data siswa
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data siswa',
            'data' => $siswa
        ], 200);
    }

    // Tambah data siswa baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|unique:siswa',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kelas' => 'required|string',
            'no_telepon' => 'required|string',
            'tanggal_lahir' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $siswa = Siswa::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    // Get detail siswa by ID
    public function show($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data siswa',
            'data' => $siswa
        ], 200);
    }

    // Update data siswa
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|unique:siswa,nis,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'kelas' => 'required|string',
            'no_telepon' => 'required|string',
            'tanggal_lahir' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $siswa->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diupdate',
            'data' => $siswa
        ], 200);
    }

    // Delete data siswa
    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil dihapus'
        ], 200);
    }
}
