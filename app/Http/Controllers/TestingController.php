<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    //
    public function index()
    {
        $data = Produk::where('nama', 'Adnan')->select('id_produk')->first()['id_produk'];

        return response()->json(["id" => $data], 200);
    }
}
