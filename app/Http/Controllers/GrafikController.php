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
        $pagename = "Grafik Harga Komoditas";
        $comodities = DB::table('daftar_komoditas')->where('status','ada')->get();
        $markets = DB::table('daftar_pasar')->get();
        $image = null;
        $data = [
            'filename'=>null,
            'next_predict'=>null,
        ];
        $startDate = null;
        $endDate = null;
        if(count($request->all()) > 0)
        {

            $startDate = $request->tanggal_start;
            $endDate = $request->tanggal_end;
            if($request->next_predict)
            {
                $endDate = Carbon::parse($endDate)->addDays($request->next_predict)->format('Y-m-d');
            }
            $check = DB::table('hasil_prediksi')
                    ->where('pasar_id',$request->pasar)
                    ->where('komoditas_id',$request->komoditas)
                    ->where('start_date',$startDate)
                    ->where('end_date',$endDate)
                    ->first();
            if($check)
            {
                //if one
                $hitEncode = json_decode($check->data,true);
                $data['filename'] = 'http://127.0.0.1:8008/api/v1/get_chart?name='.$hitEncode['filename'];
            }else{
                $url = 'http://127.0.0.1:8008/api/v1/predict?komoditas_id='.$request->komoditas.'&pasar_id='.$request->pasar.'&start_date='.$startDate.'&end_date='.$endDate.'';
                $hit = $this->processData($url);
                $hitEncode = json_decode($hit,true);

                sleep(3);

                $data['filename'] = 'http://127.0.0.1:8008/api/v1/get_chart?name='.$hitEncode['filename'];
                DB::table('hasil_prediksi')->insert([
                    'komoditas_id'=>$request->komoditas,
                    'pasar_id'=>$request->pasar,
                    'start_date'=>$startDate,
                    'end_date'=>$endDate,
                    'data'=>$hit,
                    'created_at'=>Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
                ]);
            }
        }

        $comoditiesSelectedValue = null;
        $comoditiesSelected = DB::table('daftar_komoditas')->where('id',$request->komoditas)->first();
        if($comoditiesSelected)
        {
            $comoditiesSelectedValue = $comoditiesSelected->nama_komoditas;
        }

        $pasarSelectedValue = null;
        $pasarSelected = DB::table('daftar_komoditas')->where('id',$request->komoditas)->first();
        if($pasarSelected)
        {
            $pasarSelectedValue = $pasarSelected->nama_komoditas;
        }
        return view('grafik.index', compact('pagename', 'comodities', 'markets','data','request','pasarSelectedValue','comoditiesSelectedValue','startDate','endDate'));
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
    public function processData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        return $response;
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
