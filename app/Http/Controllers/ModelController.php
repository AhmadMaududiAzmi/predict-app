<?php

namespace App\Http\Controllers;

use App\Models\ModelTrained;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function getModel() {
        $model = ModelTrained::where('model')->first();

        if ($model) {
            // Mendapatkan model dari database
            $modelData = unserialize($model->model); // Pastikan model disimpan dalam format yang sesuai
       
            // Gunakan model untuk prediksi
            // ...
            return "Model LSTM berhasil diambil dan digunakan untuk prediksi.";
        } else {
            return "Model LSTM tidak ditemukan.";
        }
    }

    public function saveModel(Request $request)
    {
        $client = new Client();
        $base_url = 'http://127.0.0.1:8008/api/v1/saveModel';

        try {
            $response = $client->post($base_url);
            $result = json_decode($response->getBody(), true);

            if ($result && $result['message'] === "Model LSTM berhasil disimpan ke database.") {
                return "Model LSTM berhasil disimpan ke database Flask.";
            } else {
                return "Gagal menyimpan model ke database Flask.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
