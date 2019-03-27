<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    //The table associated with the model
    protected $table = 'barang_keluar';

    //Set if the primary key column is not id
    protected $primaryKey = 'id_barang_keluar';

    protected $foreignkey = 'id_transaksi';

    //Set the column that can to be CRUD
    protected $fillable = ['id_transaksi', 'id_barang', 'jumlah_barang', 'subtotal'];

    //protected $casts = ['id_barang' => 'string', 'nama_barang' => 'string', 'harga_barang' >= 'string'];

    public function Transaksi(){
        return $this->hasMany('App\Transaksi','id_transaksi', 'id_transaksi');
    }

    public function Barang(){
        return $this->belongsTo('App\Barang', 'id_barang','id_barang');
    }
}