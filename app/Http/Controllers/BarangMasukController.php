<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Barang;
use App\BarangMasuk;
use App\Transaksi;
use Auth;
use Log;
use JavaScript;

class BarangMasukController extends Controller
{
    public function index()
    {
        #$barang = Barang::get(['nama_barang as name','id_barang as id','0 as price']);
        $barang = DB::table('barang')->select(DB::raw('id_barang as id,nama_barang as name, 0 as price'))->get();
        #$barang = Barang::get(['nama_barang as name','id_barang as id','harga_barang as price']);
        Log::debug($barang);
        JavaScript::put([
            'barang' => $barang
         ]);

        return view('barangmasuk');
    }

    public function getlist(){
        $barangmasuk = DB::table('barang')->select(DB::raw('id_barang,nama_barang, 0 as harga_barang'))->get();
        return $barangmasuk;
    }

    public function store(Request $request)
    {
        /*Log::debug('message');
        $id_user = Auth::user()->id_user;
        $total_cart = $request->input('total_cart');
        $total_pay = $request->input('total_cart');
        $jenis_transaksi = $request->input('jenis_transaksi');
        $transaksi_data = Transaksi::create(['id_user' => $id_user, 'total_jumlah' => $total_cart, 'total_bayar' =>
        $total_pay,'jenis_transaksi'=> $jenis_transaksi]);
        Log::debug($transaksi_data);
        $transaksi_id = $transaksi_data->id_transaksi;
        Log::debug($transaksi_id);
        $arr_item_id = $request->input('cart_id');
        $arr_item_qty = $request->input('cart_qty');
        $arr_item_curr = $request->input('cart_price');
        $i = 0;
        foreach($arr_item_id as $id){
            $qty = $arr_item_qty[$i];
            $curr = $arr_item_curr[$i];
            BarangMasuk::create(['id_transaksi' => $transaksi_id, 'id_barang' => $id, 'jumlah_barang' => $qty, 'harga_beli' =>
            $curr]);
            $i++;
        }
        return 1;*/
        DB::beginTransaction();
        try {
            $id_kas = date("Y-m-d")."-kas-koperasi-harian";
            $id_user = Auth::user()->id_user;
            $total_cart = $request->input('total_cart');
            $total_pay = $request->input('pay');
            $type = $request->input('type');
            $transaksi_data = Transaksi::create(['id_user' => $id_user, 'total_jumlah' => $total_cart, 'total_bayar' => $total_pay, 'jenis_transaksi' => $type, 'id_kas' => $id_kas, 'status_kas' => 0]);
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
                BarangMasuk::create(['id_transaksi' => $transaksi_id, 'id_barang' => $id, 'jumlah_barang' => $qty, 'harga_beli' =>
                $curr]);
                //BarangKeluar::create(['id_transaksi' => $transaksi_id, 'id_barang' => $id, 'jumlah_barang' => $qty, 'subtotal' => $curr]);
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