<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Barang;
use App\BarangKeluar;
use App\Transaksi;
use Auth;
use JavaScript;

class CashierController extends Controller
{
    public function index()
    {
        $barang = Barang::get(['nama_barang as name','id_barang as id','harga_barang as price']);
        $report = Transaksi::with(['BarangKeluar','user'])->get();

        JavaScript::put([
           'barang' => $barang
        ]);

        return view('cashier', ['barang' => $barang, 'report' => $report]);
    }

    public function viewTable(){
        $report = Transaksi::join('barang_keluar','transaksi.id_transaksi','barang_keluar.id_transaksi')
        ->join('barang','barang_keluar.id_barang','barang.id_barang')
        ->join('users','transaksi.id_user','users.id_user')
        ->where('transaksi.jenis_transaksi',2)
        ->get();
        //$report = Transaksi::with(['BarangKeluar','user'])->get();
        return view('cashier_view',['report' => $report]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $id_kas = date("Y-m-d")."-kas-koperasi-harian";
            $id_user = Auth::user()->id_user;
            $total_cart = $request->input('total_cart');
            $total_pay = $request->input('pay');
            $transaksi_data = Transaksi::create(['id_user' => $id_user, 'total_jumlah' => $total_cart, 'total_bayar' => $total_pay, 'jenis_transaksi' => 2, 'id_kas' => $id_kas, 'status_kas' => 0]);
            Log::debug($transaksi_data);
            Log::debug('message');
            $transaksi_id = $transaksi_data->id_transaksi;
            Log::debug($transaksi_id);
            $cart =  $request->input('cart');
            foreach($cart as $item){
                $id = $item['id'];
                $qty = $item['qty'];
                $curr = $item['price'];
                //$transaksi_id = 7678687;
                BarangKeluar::create(['id_transaksi' => $transaksi_id, 'id_barang' => $id, 'jumlah_barang' => $qty, 'subtotal' => $curr]);
            }
            DB::commit();
            return 1;
        } catch (Exception $e){
            DB::rollback();
            //throw $e;
            //throw ["status" => false, "message" => 'Failed'];
            //return response()->json(["error" => "Transaksi gagal dilakukan"]);
        }
    }

}