<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang;
class Transaksi extends Model
{
    //The table associated with the model
    protected $table = 'transaksi';

    //Set if the primary key column is not id
    protected $primaryKey = 'id_transaksi';

    //Set the column that can to be CRUD
    protected $fillable = ['id_user', 'total_jumlah', 'total_bayar', 'jenis_transaksi', 'id_kas'];

    protected $casts = ['id_user' => 'int', 'total_jumlah' => 'int', 'total_bayar' => 'int', 'jenis_transaksi' => 'int', 'id_kas' => 'string' ];

    public function report($from,$to){
        return $this->hasMany('App\BarangKeluar')->whereBetween('created_at', [$from, $to]);
    }

    public function BarangKeluar(){
        return $this->hasMany('App\BarangKeluar','id_transaksi', 'id_transaksi');
        //$barang = Barang::get();
        //return $barangkeluar->merge($barang);
    }

    public function User(){
        return $this->belongsTo('App\User','id_user', 'id_user');
    }
}