<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function show()
    {
        $allData = Kategori::all();

        return response()->json($allData, 200);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:250',
        ]);

        $data = Kategori::create($validatedData);

        return response()->json(["message" => "Data kategori ditambahkan", "data" => $data], 200);
    }

    public function delete($id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        if ($data)
        {
            $data->delete();
            return response()->json(["message" => "Data kategori di hapus " . $data['nama_kategori']], 200);
        }
        return response() -> json(['message' => 'Data kategori tidak di hapus atau tidak ada'], 404);
    }
}
