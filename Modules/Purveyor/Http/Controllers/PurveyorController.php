<?php

namespace Modules\Purveyor\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Modules\Purveyor\Services\PurveyorService;
use Modules\Purveyor\Http\Requests\PurveyorRequest;

class PurveyorController extends Controller
{
	protected $purveyor;

	protected $purveyor_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Purveyor\Entities\Purveyor $purveyor
	 * @param \Modules\Purveyor\Services\PurveyorService $purveyor_service
	 * @return void
	 */
	public function __construct(
		Purveyor $purveyor,
		PurveyorService $purveyor_service
	) {
		$this->purveyor = $purveyor;
		$this->purveyor_service = $purveyor_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('purveyor::index');
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
		$purveyors = $this->purveyor->query();

		return DataTables::of($purveyors)
			->editColumn(
				"active",
				function ($purveyor) {
					return $purveyor->formatted_active;
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
				function ($purveyor) {
					return $purveyor->actionView();
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

		return view('purveyor::create', compact('categories'));
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  \Modules\Purveyor\Http\Requests\PurveyorRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(PurveyorRequest $request)
	{
		$this->purveyor_service->updateOrCreate($request->all());

		return redirect()
			->route('purveyor.index')
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
		$purveyor = $this->purveyor->with('categories')
			->findOrFail($id);

		return view('purveyor::show', compact('purveyor'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$purveyor = $this->purveyor->with('categories')
			->findOrFail($id);

		$categories = Category::where('active', true)
			->whereNotIn('id', $purveyor->categories->pluck('id'))
			->orderBy('name', 'ASC')
			->get();

		return view('purveyor::edit', compact('purveyor', 'categories'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  \Modules\Purveyor\Http\Requests\PurveyorRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(PurveyorRequest $request, $id)
	{
		$purveyor = $this->purveyor->findOrFail($id);

		$this->purveyor_service->updateOrCreate($request->all(), $purveyor->id);

		return redirect()
			->route('purveyor.edit', $purveyor->id)
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
		$purveyor = $this->purveyor->findOrFail($id);

		return view('purveyor::confirm-delete', compact('purveyor'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$purveyor = $this->purveyor->findOrFail($id);

		$this->purveyor_service->removeData($purveyor);

		return redirect()
			->route('purveyor.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
