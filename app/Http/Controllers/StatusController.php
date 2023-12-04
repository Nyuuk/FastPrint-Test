<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    //
    public function show()
    {
        $allData = Status::all();

        return response()->json($allData, 200);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'nama_status' => 'required|string|max:250',
        ]);

        $data = Status::create($validatedData);

        return response()->json(["message" => "Data Status ditambahkan", "data" => $data], 200);
    }

    public function delete($id)
    {
        $data = Status::where('id_status', $id)->first();

        if ($data)
        {
            $data->delete();
            return response()->json(["message" => "Data Status di hapus " . $data['nama_kategori']], 200);
        }
        return response() -> json(['message' => 'Data Status tidak di hapus atau tidak ada'], 404);
    }
}
