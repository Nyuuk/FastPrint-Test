<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    //
    public function index(Request $request)
    {
        // $data = Produk::where('nama', 'Adnan')->select('id_produk')->first()['id_produk'];

        // return response()->json(["id" => $data], 200);

        $paramStatusName = $request->query('status');
        $id = Status::where('nama_status', $paramStatusName)->select('id_status')->first();
        if ($id)
        {
            return response()->json(['message' => 'oke']);
        }
        return response()->json(['param'=>$id], 200);
    }
}
