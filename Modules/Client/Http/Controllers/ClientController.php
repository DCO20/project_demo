<?php

namespace Modules\Client\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Client\Entities\Client;
use Modules\Client\Services\ClientService;
use Modules\Client\Http\Requests\ClientRequest;

class ClientController extends Controller
{
	protected $client;

	protected $client_service;

	/**
	 * Método Construtor
	 *
	 * @param \Modules\Client\Entities\Client $client
	 * @param \Modules\Client\Services\ClientService $client_service
	 * @return void
	 */
	public function __construct(
		Client $client,
		ClientService $client_service
	) {
		$this->client = $client;
		$this->client_service = $client_service;
	}

	/**
	 * Exibe a tela inicial com a listagem de dados.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('client::index');
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
		$clients = $this->client->query();

		return DataTables::of($clients)
			->editColumn(
				"date_birthday",
				function ($client) {
					return $client->formatted_date_birthday;
				}
			)
			->editColumn(
				"genre",
				function ($client) {
					return $client->formatted_genre;
				}
			)
			->editColumn(
				"price",
				function ($client) {
					return $client->formatted_price;
				}
			)
			->editColumn(
				"active",
				function ($client) {
					return $client->formatted_active;
				}
			)
			->filterColumn(
				'date_birthday',
				function ($q, $keyword) {
					$formatted_date_birthday = implode('-', array_reverse(explode('/', $keyword)));

					$q->where('date_birthday', 'LIKE', '%' . $formatted_date_birthday . '%');
				}
			)
			->filterColumn(
				'genre',
				function ($q, $keyword) {

					$formatted_keyword = strtolower($keyword);

					$genre = '';

					if ($formatted_keyword == 'masculino') {
						$genre = 'M';
					}

					if ($formatted_keyword == 'feminino') {
						$genre = 'F';
					}

					$q->where('genre', $genre);
				}
			)
			->filterColumn(
				'price',
				function ($q, $keyword) {
					$formatted_price = str_replace(',', '.', str_replace('.', '', $keyword));

					$q->where('price', 'LIKE', '%' . $formatted_price . '%');
				}
			)
			->filterColumn(
				'active',
				function ($q, $keyword) {

					$formatted_keyword = strtolower($keyword);

					$active = null;

					if ($formatted_keyword == 'não') {
						$active = false;
					}

					if ($formatted_keyword == 'sim') {
						$active = true;
					}

					$q->where('active', $active);
				}
			)
			->addColumn(
				"action",
				function ($client) {
					return $client->actionView();
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
		return view('client::create');
	}

	/**
	 * Cadastra e retorna para a tela inicial
	 *
	 * @param  \Modules\Client\Http\Requests\ClientRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(ClientRequest $request)
	{
		$this->client_service->updateOrCreate($request->all());

		return redirect()
			->route('client.index')
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
		$client = $this->client->findOrFail($id);

		return view('client::show', compact('client'));
	}

	/**
	 * Exibe os dados para edição
	 *
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$client = $this->client->findOrFail($id);

		return view('client::edit', compact('client'));
	}

	/**
	 * Atualiza e retorna para a tela de edição
	 *
	 * @param  \Modules\Client\Http\Requests\ClientRequest $request
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(ClientRequest $request, $id)
	{
		$client = $this->client->findOrFail($id);

		$this->client_service->updateOrCreate($request->all(), $client->id);

		return redirect()
			->route('client.edit', $client->id)
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
		$client = $this->client->findOrFail($id);

		return view('client::confirm-delete', compact('client'));
	}

	/**
	 * Exclui e retorna para a tela inicial
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$client = $this->client->findOrFail($id);

		$this->client_service->removeData($client);

		return redirect()
			->route('client.index')
			->with('message', 'Exclusão realizada com sucesso.');
	}
}
