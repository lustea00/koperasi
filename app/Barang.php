<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    //The table associated with the model
	protected $table = 'barang';

	//Set if the primary key column is not id
	protected $primaryKey = 'id_barang';

	//Set the column that can to be CRUD
	protected $fillable = ['id_barang', 'nama_barang', 'harga_barang'];

	protected $casts = ['id_barang' => 'string', 'nama_barang' => 'string', 'harga_barang' >= 'string'];

	public function BarangKeluar(){
		return $this->hasMany('App\BarangKeluar','id_barang', 'id_barang');
	}

	
}