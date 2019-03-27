<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdfReport;
use App\Transaksi;
use App\BarangKeluar;
use App\Barang;
use App\Kas;
use DB;


class ReportController extends Controller
{
    public function reportall(){
        /*$report = DB::table('barang_keluar')
        ->join('barang','barang_keluar.id_barang','barang.id_barang')
        ->join('barang_masuk','barang_keluar.id_barang','barang_masuk.id_barang')
        ->select(DB::raw('barang_keluar.*,barang_masuk.*,barang.*,CAST(max(barang_masuk.harga_beli)/barang_masuk.jumlah_barang AS DECIMAL(10,2)) as harga_satuan' ))
        ->where('barang_keluar.created_at','>=','barang_masuk.created_at')
        ->orderBy('barang_masuk.id_barang_masuk','DESC')
        ->groupBy('barang_keluar.id_barang_keluar')
        ->get();
        return $report;*/
    }

    public function journal(){
        $journal = Kas::get();
        return view('journal', ['report' => $journal]);
    }

}