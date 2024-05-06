<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\ApiLayanan;

class KategoriController extends Controller
{

    public function show(){
        $kategori = Kategori::all(); 
        return view('page.kategori.index', compact('kategori'));
    }
    public function getKategori(Request $request)
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

                // Membuat array kosong untuk menyimpan data kategori
                $categories = [];

                // Mengambil kategori dari setiap entri data respons
                foreach ($responseData['data'] as $data) {
                    $categories[] = $data['category'];
                }

                // Menghapus duplikat kategori
                $uniqueCategories = array_unique($categories);

                // Simpan atau perbarui kategori ke database
                foreach ($uniqueCategories as $category) {
                    Kategori::updateOrCreate(['nama' => $category]);
                }

                // Mengirim respons JSON dengan kategori yang unik
                return response()->json(['status' => true, 'msg' => 'OK', 'data' => $uniqueCategories]);
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
