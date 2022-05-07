<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;

class ApiProductController extends Controller
{
	public function index()
	{
		return Product::all();
	}

	public function store(Request $request)
	{
		Product::create($request->all());
	}

	public function show($id)
	{
		return Product::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$product = Product::findOrFail($id);
		$product->update($request->all());
	}

	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();
	}
}
