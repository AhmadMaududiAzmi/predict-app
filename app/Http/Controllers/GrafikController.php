<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PrediksiController;
use App\Models\ListComodities;
use App\Models\Market;
use App\Models\PriceComodities;
use App\Services\FlaskApiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GrafikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagename = "Grafik Harga Komoditas";
        $comodities = ListComodities::all();
        $markets = Market::groupBy('kota_kab')->get();
        return view('grafik.index', compact('pagename', 'comodities', 'markets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pagename = 'Grafik Komoditas';
        $request->validate([
            'komoditas_option' => 'required',
            'kota_option' => 'required',
            'pasar_option' => 'required',
            'datepickerStart' => 'required',
            'datepickerEnd' => 'required'
        ]);

        $nm_komoditas = $request->input('komoditas_option');
        $kota_kab = $request->input('kota_option');
        $nm_pasar = $request->input('pasar_option');
        $tglAwal = $request->input('datepickerStart');
        $tglAkhir = $request->input('datepickerEnd');
        
        // Ubah sintaks dibawah menjadi PHP
        // SELECT harga_komoditas.*, daftar_pasar.kota_kab FROM harga_komoditas JOIN daftar_pasar ON harga_komoditas.nm_pasar = daftar_pasar.nama_pasar WHERE harga_komoditas.nm_komoditas = 'Gula Pasir Dalam Negri' AND harga_komoditas.nm_pasar = 'Pasar Dinoyo' AND daftar_pasar.kota_kab = 'Kota Malang' AND harga_komoditas.tanggal BETWEEN '2017-01-01' AND '2018-01-01';
        
        $data = PriceComodities::join('daftar_pasar', 'harga_komoditas.nm_pasar', '=', 'daftar_pasar.nama_pasar')
        ->where('harga_komoditas.nm_komoditas', '=', $nm_komoditas)
        ->where('harga_komoditas.nm_pasar', '=', $nm_pasar)
        ->where('daftar_pasar.kota_kab', '=', $kota_kab)
        ->whereBetween('harga_komoditas.tanggal', [$tglAwal, $tglAkhir])
        ->get(['harga_komoditas.*', 'daftar_pasar.kota_kab']);
        // dd($data);
        return redirect('/grafik', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            // Sintaks jika terjadi error dalam proses pengolahan data
            return response()->json(['error'=>$e->getMessage()], 500);
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
