<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;

class BarangController extends Controller
{
	public function index()
	{
		$barang = Barang::all();
		return $barang;
	}

	public function show($id)
	{
		return Barang::find($id);
	}

	public function store(Request $request)
	{
		return Barang::create($request->all());
	}

	public function update(Request $request, $id)
	{
		$article = Barang::findOrFail($id);
		$article->update($request->all());

		return $article;
	}

	public function delete(Request $request, $id)
	{
		$article = Barang::findOrFail($id);
		$article->delete();

		return 204;
	}
}
