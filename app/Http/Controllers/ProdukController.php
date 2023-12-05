<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $statusView = $request->query('status');
        // if statusView is not null
        if ($statusView) {
            // check statusView in database statuses which is in Status Model
            $status = Status::where('nama_status', $statusView)->select('id_status')->first();
            // if status is not null
            if ($status) {
                $statusId = $status['id_status'];
                $allInp = Produk::where('status_id', $statusId)->get();
            } else {
                $allInp = Produk::all();
            }
        } else {
            $allInp = Produk::all();
        }
        // $data = Produk::all();

        return response()->json($allInp, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|string|max:250',
            'harga' => 'required|integer',
            'kategori_id' => 'integer',
            'status_id' => 'integer'
        ]);

        $data = Produk::create($validatedData);

        return response()->json(["message" => "Data produk ditambahkan", "data" => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|string|max:250',
            'harga' => 'required|integer',
            'kategori_id' => 'integer',
            'status_id' => 'integer'
        ]);

        $data = Produk::where('id_produk', $id)->first();

        if ($data)
        {
            $data->update($validatedData);
            return response()->json(["message" => "Data produk di ubah " . $data['nama']], 200);
        }
        return response() -> json(['message' => 'Data produk tidak di ubah atau tidak ada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Produk::where('id_produk', $id)->first();

        if ($data)
        {
            $data->delete();
            return response()->json(["message" => "Data produk di hapus " . $data['nama']], 200);
        }
        return response() -> json(['message' => 'Data produk tidak di hapus atau tidak ada'], 404);
    }
}
