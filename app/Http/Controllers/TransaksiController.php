<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\BarangKeluar;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function viewTable(){
        $report = Transaksi::join('users','transaksi.id_user','users.id_user')->get();
        return view('transaction_view',['report' => $report]);
    }
}