<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PrediksiController;
use App\Models\ListComodities;
use App\Models\Market;
use App\Services\FlaskApiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GrafikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagename = "Grafik Harga Komoditas";
        $comodities = ListComodities::all();
        $markets = Market::distinct('kota_kab')->get();
        return view('grafik.index', compact('pagename', 'comodities', 'markets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comodities = ListComodities::all();
        return view('grafik.create', compact('comodities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ListComodities::updateOrCreate(
        [
            'id' => $request->id
        ],
        [
            'comodity' => $request->nama_komoditas,
            'market' => $request->nm_pasar
        ]);

        return response()->json(['Loading'=>'Product will predicted']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $markets = Market::all();
        // $uniqueData = $markets->unique();

        // return view('grafik.index', ['data'=>$uniqueData]);        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Processing dataframe (get process from API)
     */
    public function processData()
    {
        $client = new Client([
            'base_url' => 'http://127.0.0.1:8008/api/v1/getdataframe'
        ]);

        try{
            $response = $client->get('/api/v1/getdataframe');
            $data = json_decode($response->getBody()->getContents(), true);

            return response()->json($data);
        } catch (\Exception $e){
            // Tambahkan sintaks jika terjadi error dalam proses pengolahan data
        }
    }

    /**
     * Show graph of data (get data from API)
     */
    public function showGraph()
    {
        $client = new Client();
        $base_url = 'http://127.0.0.1:8008/api/v1/prediksi';

        try{
            $response = $client->get($base_url);
            $data = json_decode($response->getBody()->getContents(), true);

            $labels = [];
            $values = [];

            foreach ($data as $item){
                $labels = $item['tanggal'];
                $values = $item['harga_current'];
            }

            return view('grafik.index', compact('labels', 'values'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan.'], 500);
        }
    }
}
