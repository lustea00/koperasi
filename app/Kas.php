<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    //The table associated with the model
    protected $table = 'kas';

    //Set if the primary key column is not id
    protected $primaryKey = 'id_kas';

    //protected $foreignkey = 'id_transaksi';

    //Set the column that can to be CRUD
    protected $fillable = ['jenis_kas', 'nama_kas', 'jumlah_kas','saldo kas'];

    //protected $casts = ['id_transaksi' => 'int', 'id_barang' => 'string', 'harga_barang' => 'string','jumlah_barang' => 'int'];
}