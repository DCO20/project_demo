<?php

namespace Modules\Suit\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Suit\Entities\Suit;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Product\Entities\Product;
use Modules\Suit\Services\SuitService;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Modules\Suit\Http\Requests\SuitRequest;

class SuitController extends Controller
{
	protected $suit;

	protected $suit_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Suit\Entities\Suit $suit
	 * @param \Modules\Suit\Services\SuitService $suit_service
	 * @return void
	 */
	public function __construct(
		Suit $suit,
		SuitService $suit_service
	) {
		$this->suit = $suit;
		$this->suit_service = $suit_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('suit::index');
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
		$suits = $this->suit->with('client');

		return DataTables::of($suits)
			->editColumn(
				"date",
				function ($suit) {
					return $suit->formatted_date;
				}
			)
			->editColumn(
				"status",
				function ($suit) {
					return $suit->formatted_status;
				}
			)
			->addColumn(
				"client",
				function ($suit) {
					return $suit->client->name;
				}
			)
			->addColumn(
				"action",
				function ($suit) {
					return $suit->actionView();
				}
			)
			->filterColumn(
				'suit_date',
				function ($q, $keyword) {
					$formatted_date = implode('-', array_reverse(explode('/', $keyword)));

					$q->where('suit_date', 'LIKE', '%' . $formatted_date . '%');
				}
			)
			->filterColumn(
				'status',
				function ($q, $keyword) {

					$formatted_keyword = strtolower($keyword);

					$status = '';

					if ($formatted_keyword == 'finalizado') {
						$status = 'Finished';
					}

					if ($formatted_keyword == 'pendente') {
						$status = 'Pending';
					}

					$q->where('status', $status);
				}
			)
			->rawColumns(
				[
					'description',
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
		$clients = Client::where('active', true)->orderBy('name', 'AsC')->get();

		$purveyors = Purveyor::where('active', true)->orderBy('name', 'AsC')->get();

		return view('suit::create', compact('clients', 'purveyors'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  \Modules\Suit\Http\Requests\SuitRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(SuitRequest $request)
	{
		$this->suit_service->updateOrCreate($request->all());

		return redirect()
			->route('suit.index')
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
		$suit = $this->suit->with([
			'client',
			'suitProducts' => function ($q) {
				$q->with([
					'category',
					'product',
					'purveyor'
				]);
			}
		])
			->findOrFail($id);

		return view('suit::show', compact('suit'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$suit = $this->suit->with([
			'client',
			'suitProducts' => function ($q) {
				$q->with([
					'category',
					'product',
					'purveyor'
				]);
			}
		])
			->findOrFail($id);

		$clients = Client::orderBy('name')
			->where('id', '!=', $suit->client->id)
			->get();

		return view('suit::edit', compact('suit', 'clients'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  \Modules\Suit\Http\Requests\SuitRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(SuitRequest $request, $id)
	{
		$suit = $this->suit->findOrFail($id);

		$this->suit_service->updateOrCreate($request->all(), $suit->id);

		return redirect()
			->route('suit.edit', $suit->id)
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
		$suit = $this->suit->with('client')->findOrFail($id);

		return view('suit::confirm-delete', compact('suit'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$suit = $this->suit->findOrFail($id);

		$this->suit_service->removeData($suit);

		return redirect()
			->route('suit.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}

	public function addPurveyor(Request $request)
	{
		$purveyors = Purveyor::where('active', true)
			->with('categories')
			->get();

		return response()->json([
			'success' => true,
			'html' => view('suit::partials.add-purveyor', [
				'purveyor_index' => $request->index,
				'purveyors' => $purveyors
			])
				->render()
		]);
	}

	/**
	 * Carregamento das categorias
	 * @param Request $request
	 *
	 */
	public function loadCategory(Request $request)
	{
		$categories = Category::whereHas('purveyors', function ($q) use ($request) {
			$q->where('purveyor_id', $request->purveyor_id);
		})
			->orderby('name')
			->get();

		return response()->json($categories);
	}

	/**
	 * Carregamento dos produtos
	 * @param Request $request
	 *
	 */
	public function loadProduct(Request $request)
	{
		$products = Product::whereHas('categories', function ($q) use ($request) {
			$q->where('category_id', $request->category_id);
		})
			->orderby('name')
			->get();

		return response()->json($products);
	}
}
