<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    //The table associated with the model
    protected $table = 'barang_masuk';

    //Set if the primary key column is not id
    protected $primaryKey = 'id_barang_masuk';

    protected $foreignkey = 'id_transaksi';

    //Set the column that can to be CRUD
    protected $fillable = ['id_transaksi', 'id_barang', 'jumlah_barang','harga_beli'];

    protected $casts = ['id_transaksi' => 'int', 'id_barang' => 'string', 'harga_barang' => 'string','jumlah_barang' => 'int'];
    
}