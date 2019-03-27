<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class PassingVueController extends Controller
{
	public function index(){
		//$barang = Barang::all();
		$barang = Barang::get(['nama_barang as name','id_barang as id','harga_barang as price']);
		return view('cashier', ['barang' => $barang]);
	}
}
