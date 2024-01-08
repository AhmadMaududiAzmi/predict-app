<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PrediksiController;
use App\Models\ListComodities;
use App\Models\Market;
use App\Models\PredictionResults;
use App\Models\PriceComodities;
use App\Services\FlaskApiService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $pagename = 'Grafik Harga Komoditas';
        $comodities = DB::table('daftar_komoditas')->where('status', 'ada')->get();
        $markets = DB::table('daftar_pasar')->get();
        $startDate = null;
        $endDate = null;
        $data = [
            'predicted_data' => null,
            'new_predicted_data' => null
        ];

        if (count($request->all()) > 0) {
            $startDate = $request->tanggal_awal;
            $endDate = $request->tanggal_akhir;
            if ($request->new_predicted_data) {
                $endDate = Carbon::parse($endDate)->addDays($request->new_predicted_data)->format('Y-m-d');
            }

            $check = DB::table('hasil_prediksi')
                ->where('komoditas_id', $request->komoditas)
                ->where('pasar_id', $request->pasar)
                ->where('tanggal_awal', $startDate)
                ->where('tanggal_akhir', $endDate)
                ->first();

            if (isset($check)) {
                $data = json_decode($check->predicted_data, true);
                return $data;
            } else {
                $trainUrl = Http::timeout(0)->get('http://127.0.0.1:8008/api/v1/traindata', [
                    'komoditas_id' => $request->komoditas,
                    'pasar_id' => $request->pasar,
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]);
                // dd($trainUrl);

                // $trainUrl = 'http://127.0.0.1:8008/api/v1/traindata?komoditas_id='.$request->komoditas.'&pasar_id='.$request->pasar.'&start_date='.$startDate.'&end_date='.$endDate.'';
                // $hit = $this->proccessData($trainUrl);
                $data = json_decode($trainUrl, true);
                return $data;
            }
        }

        $comoditiesSelectedValue = null;
        $comoditiesSelected = DB::table('daftar_komoditas')->where('id', $request->komoditas)->first();
        if ($comoditiesSelected) {
            $comoditiesSelectedValue = $comoditiesSelected->nama_komoditas;
        }

        $pasarSelectedValue = null;
        $pasarSelected = DB::table('daftar_pasar')->where('id', $request->pasar)->first();
        if ($pasarSelected) {
            $pasarSelectedValue = $pasarSelected->nm_pasar;
        }
        // dd($request->all());
        return view('grafik.index', compact('pagename', 'comodities', 'markets', 'request', 'pasarSelectedValue', 'comoditiesSelectedValue', 'startDate', 'endDate', 'data'));
    }

    /**
     * Processing dataframe (get process from API)
     */
    public function proccessData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        return $response;
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

        $data = PriceComodities::join('daftar_pasar', 'daftar_harga.nm_pasar', '=', 'daftar_pasar.nm_pasar')
            ->where('daftar_harga.nama_komoditas', '=', $nm_komoditas)
            ->where('daftar_harga.nm_pasar', '=', $nm_pasar)
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

    function nextPrediction(Request $request) {
        $predict = Http::timeout(0)->get('http://127.0.0.1:8008/api/v1/predictdata', [
            'komoditas_id' => $request->komoditas,
            'pasar_id' => $request->pasar,
            'start_date' => $request->tanggal_awal,
            'end_date' => $request->tanggal_akhir,
            'new_predicted_data' => $request->next_predict
        ]);

        return json_encode($predict);
    }
}
