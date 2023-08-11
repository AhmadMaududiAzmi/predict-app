<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DataController extends Controller
{
	public function data()
	{
		$pasar = DB::table('daftar_pasar')->get();
		$total = 0;
		foreach ($pasar as $key => $value) 
		{
			$harga = DB::table('daftar_harga')->where('nm_pasar',$value->nm_pasar)->first();
			if($harga)
			{
				DB::table('daftar_harga')->where('nm_pasar',$value->nm_pasar)->update([
					'nm_pasar'=>$value->id
				]);
				$total++;
			}
		}

		return $total;
	}

	public function getNotInt()
	{
		$pasar = DB::table('daftar_pasar')->get();
		$arr = [];
		foreach ($pasar as $key => $value) 
		{
			$harga = DB::table('daftar_harga')->where('pasar_id',$value->id)->get();
			if($harga->isEmpty())
			{
				array_push($arr, $value->id);
			}
		}

		$arr = implode(',', $arr);
		return $arr;
	}
}