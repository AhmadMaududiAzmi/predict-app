<?php

namespace App\Http\Controllers;

use App\Models\ListComodities;
use App\Models\Market;
use App\Models\PriceComodities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class DetailController extends Controller
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
        $pagename = 'Detail Komoditas';
        return view('detail.index', compact('pagename'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage or get data.
     */
    public function store(Request $request, string $id)
    {
        $pagename = 'Detail Komoditas';
        $request->validate([
            'kota_option' => 'required',
            'pasar_option' => 'required',
        ]);
        
        $kota_kab = $request->Input('kota_option');
        $nm_pasar = $request->Input('pasar_option');

        // $markets = Market::groupBy('kota_kab')->get();
        $data = PriceComodities::join('daftar_pasar', 'harga_komoditas.nm_pasar', '=', 'daftar_pasar.nama_pasar')
            ->where('harga_komoditas.id_komuditas', '=', $id)
            ->where('kota_kab', '=', $kota_kab)
            ->where('nm_pasar', '=', $nm_pasar)
            ->get(['harga_komoditas.*', 'daftar_pasar.kota_kab']);
        return view('detail.index', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pagename = 'Detail Komoditas';

        // Grafik
        $harga_current = PriceComodities::select(DB::raw('harga_current'))
        ->where('id_komuditas', $id)
        ->where('nm_pasar', '=', 'Pasar Dinoyo')
        ->groupBy(DB::raw('tanggal'))
        ->pluck('harga_current');
        $tanggal = PriceComodities::select(DB::raw('tanggal'))
        ->where('id_komuditas', $id)
        ->where('nm_pasar', '=', 'Pasar Dinoyo')
        ->groupBy(DB::raw('tanggal'))
        ->pluck('tanggal');
        // $pasar = PriceComodities::select(DB:raw('nm_pasar'))
        // ->where('id_komuditas', $id)
        // ->where('nm_pasar', '=', 'Pasar Dinoyo')
        // pluck('nm_pasar');

        // Tabel
        $comodities = PriceComodities::where('id_komuditas', $id)
            ->groupBy('tanggal')
            ->paginate(30);

        $maxHarga = PriceComodities::max('harga_current');
        $minHarga = PriceComodities::min('harga_current');
        $avgHarga = DB::table('harga_komoditas')->avg('harga_current');
        $markets = Market::groupBy('kota_kab')->get();
        return view('detail.index', compact('pagename', 'markets', 'comodities', 'maxHarga', 'minHarga', 'avgHarga', 'harga_current', 'tanggal'));
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
     * Show graph of data
     */
    // public function showGraph()
    // {
    //     $data = PriceComodities::select('harga_komoditas.*')
    //         ->where('id_komuditas', '=', $id)
    //         ->where('tanggal', '=', $tanggal)
    //         ->where('harga', '=', $harga_current)
    //         ->groupBy('tanggal')
    //         ->get();
        
    //     return view()
    // }
}
