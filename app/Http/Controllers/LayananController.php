<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\ApiLayanan;
use App\Models\Kategori;

class LayananController extends Controller
{

    public function show(){
        $layanan = Layanan::with('kategori')->get();
        return view('page.layanan.index', compact('layanan'));

    }
    public function getLayanan(Request $request)
    {
        // Ambil data API Layanan pertama dari database
        $api = ApiLayanan::select('key', 'key_id', 'profit_percentage')->first();

        // Periksa apakah data API ditemukan
        if ($api) {
            $apiKey = $api->key;
            $key_id = $api->key_id;

            // Buat instance dari Guzzle Client
            $client = new Client();

            try {
                // Lakukan request ke API menggunakan Guzzle
                $response = $client->post('https://api.medanpedia.co.id/services', [
                    'form_params' => [
                        'api_id' => $key_id,
                        'api_key' => $apiKey,
                    ]
                ]);

                // Mendapatkan konten respons dari API
                $content = $response->getBody()->getContents();

                // Mengonversi konten respons ke dalam bentuk array
                $responseData = json_decode($content, true);

                // Iterasi data layanan dari respons API
                foreach ($responseData['data'] as $data) {
                    // Cek apakah kategori layanan sudah ada dalam tabel Kategori
                    $kategori = Kategori::where('nama', $data['category'])->first();

                    // Jika kategori layanan sudah ada dalam tabel Kategori
                    if ($kategori) {
                        // Buat atau perbarui data layanan
                        Layanan::updateOrCreate(
                            ['id' => $data['id']], // Gunakan id dari respons sebagai referensi untuk update atau create
                            [
                                'name' => $data['name'],
                                'type' => $data['type'],
                                'kategori_id' => $kategori->id, // Gunakan id kategori yang sesuai
                                'price' => $data['price'],
                                'min' => $data['min'],
                                'max' => $data['max'],
                                'description' => $data['description'],
                                'refill' => $data['refill'],
                                'average_time' => $data['average_time'],
                            ]
                        );
                    }
                }

                // Mengirim respons JSON sukses
                return response()->json(['status' => true, 'msg' => 'Data layanan berhasil disimpan']);
            } catch (\Exception $e) {
                // Tangani pengecualian jika terjadi kesalahan saat mengakses API
                // Misalnya, tampilkan pesan kesalahan atau lakukan tindakan pemulihan.
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            // Tangani kasus jika tidak ada data API yang ditemukan di database
            return response()->json(['error' => 'Data API tidak ditemukan'], 404);
        }
    }
}
