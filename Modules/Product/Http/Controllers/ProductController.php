<?php

namespace Modules\Product\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Services\ProductService;
use Modules\Product\Http\Requests\ProductRequest;

class ProductController extends Controller
{

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Product\Entities\Product $product
	 * @param \Modules\Product\Services\ProductService $product_service
	 * @return void
	 */
	public function __construct(
		protected Product $product,
		protected ProductService $product_service
	) {
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('product::index');
	}

	/**
	 * Obtêm os dados para a tabela
	 *
	 * @codeCoverageIgnore
	 *
	 * @return string
	 */
	public function dataTable()
	{
		$products = $this->product->query();

		return DataTables::of($products)
			->editColumn(
				"active",
				function ($product) {
					return $product->formatted_active;
				}
			)
			->editColumn(
				"price",
				function ($product) {
					return $product->formatted_price;
				}
			)
			->filterColumn(
				'price',
				function ($q, $keyword) {
					$formatted_price = str_replace(',', '.', str_replace('.', '', $keyword));

					$q->where('price', 'LIKE', '%' . $formatted_price . '%');
				}
			)
			->addColumn(
				"category",
				function ($product) {
					return $product->formatCategoryName();
				}
			)
			->addColumn(
				"action",
				function ($product) {
					return $product->actionView();
				}
			)
			->rawColumns(
				[
				'active',
				'action'
				]
			)
			->make(true);
	}

	/**
	 * Exibe a tela de cadastro
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$categories = Category::where('active', true)->orderBy('name', 'ASC')->get();

		return view('product::create', compact('categories'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  \Modules\Product\Http\Requests\ProductRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ProductRequest $request)
	{
		$this->product_service->updateOrCreate($request->all());

		return redirect()
			->route('product.index')
			->with('message', 'Cadastro realizado com sucesso.');
	}

	/**
	 * Exibe os dados
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function show($id)
	{
		$product = $this->product->with('categories')
			->findOrFail($id);

		return view('product::show', compact('product'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$product = $this->product->with('categories')->findOrFail($id);

		$categories = Category::where('active', true)
			->whereNotIn('id', $product->categories->pluck('id'))
			->orderBy('name', 'ASC')
			->get();

		return view('product::edit', compact('product', 'categories'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  \Modules\Product\Http\Requests\ProductRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ProductRequest $request, $id)
	{
		$product = $this->product->findOrFail($id);

		$this->product_service->updateOrCreate($request->all(), $product->id);

		return redirect()
			->route('product.edit', $product->id)
			->with('message', 'Atualização realizada com sucesso.');
	}

	/**
	 * Exibe a tela para exclusão
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function confirmDelete($id)
	{
		$product = $this->product->findOrFail($id);

		return view('product::confirm-delete', compact('product'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$product = $this->product->findOrFail($id);

		$this->product_service->removeData($product);

		return redirect()
			->route('product.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
