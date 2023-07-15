<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    const FETCHED_ATTRIBUTE = [
        'nama_pasar',
        'kota/kabupaten'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagename = 'Daftar Pasar';
        $markets = Market::all();
        return view('markets.index', compact('pagename', 'markets'));
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
        $data = $request->only(self::FETCHED_ATTRIBUTE);
        $markets = Market::created($data);
        if ($this->responType()) {
            return response()->json([
                'succes' => true,
                'message' => 'Data pasar berhasil ditambah',
                'data' => $markets
            ], 200);
        } else {
            return redirect('/pasar')->with('message', 'Data berhasil ditambah');
        }
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
