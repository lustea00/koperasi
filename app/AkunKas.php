<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunKas extends Model
{
    //The table associated with the model
    protected $table = 'akun_kas';

    //Set if the primary key column is not id
    protected $primaryKey = 'id_akun_kas';

    //protected $foreignkey = 'id_transaksi';

    //Set the column that can to be CRUD
    protected $fillable = ['nama_akun_kas', 'keterangan'];

    //protected $casts = ['id_transaksi' => 'int', 'id_barang' => 'string', 'harga_barang' => 'string','jumlah_barang' => 'int'];
}