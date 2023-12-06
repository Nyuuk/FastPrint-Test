<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurlController extends Controller
{
    //
    private function getDataApi()
    {
        // Set the time zone to Jakarta
        date_default_timezone_set('Asia/Jakarta');

        $today = Carbon::now();
        $day = $today->format('d');
        $month = $today->format('m');
        $year = $today->format('y');

        $string_password = "bisacoding-$day-$month-$year";

        // MD5 hash
        $md5_result = md5($string_password);

        $url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";
        $data = [
            "username" => "asal",
            "password" => $md5_result
        ];

        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        // Close cURL session
        curl_close($ch);

        // Parse headers into an associative array
        $headerLines = explode("\r\n", $headers);
        $headerData = [];
        foreach ($headerLines as $line) {
                $parts = explode(": ", $line, 2);
                if (count($parts) === 2) {
                        $headerData[$parts[0]] = $parts[1];
                }
        }

        // Get the value of the specific header (e.g., X-Credential-Name)
        $xCredentialName = isset($headerData['x-credentials-username']) ? $headerData['x-credentials-username'] : null;


        $decoded_response = $xCredentialName;

        if ($decoded_response) {
            $username = explode(' ', $decoded_response)[0];
            $data['username'] = $username;
            // print_r($data);

            // Make a second request with updated data
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close cURL session
            curl_close($ch);

            return json_decode($response, true);
        } else {
            return false;
        }
    }

    private function newStatus($nama)
    {
        if (!Status::where('nama_status', $nama)->exists()) {
            Status::create([
                'nama_status' => $nama
            ]);
        }
    }

    private function newKategori($nama)
    {
        if (!Kategori::where('nama_kategori', $nama)->exists()) {
            Kategori::create([
                'nama_kategori' => $nama
            ]);
        }
    }

    public function index()
    {
        $dataApi = $this->getDataApi();
        $dataDb = Produk::select('id_produk')->get();

        $ids = $dataDb->pluck('id_produk');

        $dataSuccess = [];

        foreach ($dataApi['data'] as $e)
        {
            $this->newStatus($e['status']);
            $this->newKategori($e['kategori']);
        }

        foreach ($dataApi['data'] as $value) {
            // check if $value['name'] and $value['harga'] are not present in Database
            if (!in_array($value['id_produk'], $ids->toArray())) {
                // then add data to Produk Tabel
                $kategoriId = Kategori::where('nama_kategori', $value['kategori'])->select('id_kategori')->first();
                $statusId = Status::where('nama_status', $value['status'])->select('id_status')->first();
                $dataToAdd = [
                    'nama' => $value['nama_produk'],
                    'id_produk' => $value['id_produk'],
                    'kategori_id' => $kategoriId['id_kategori'],
                    'status_id' => $statusId['id_status'],
                    'harga' => $value['harga']
                ];
                $add = Produk::create($dataToAdd);
                $dataSuccess[] = $add;
            }
        }
        // check dataSuccess
        if ($dataSuccess) {
            return response()->json(["message" => "Data produk ditambahkan", "data" => $dataSuccess], 200);
        }
        return response()->json(["message" => "tidak ada data yang di tambahkan"], 400);
    }
}
