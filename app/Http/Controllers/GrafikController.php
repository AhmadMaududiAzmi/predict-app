<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PrediksiController;
use App\Models\ListComodities;
use App\Models\Market;

class GrafikController extends Controller
{
    /**
     * Memanggil variabel pada controller lain (pada kasus ini dalam file .py)
     */
    protected $predict;

    public function __construct(PrediksiController $predict)
    {
        $this->predict = $predict;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagename = "Grafik Harga Komoditas";
        $predict = $this->predict->index();
        $comodities = ListComodities::all();
        $markets = Market::all();
        return view('grafik.index', compact('pagename', 'predict', 'comodities', 'markets'));
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
}
