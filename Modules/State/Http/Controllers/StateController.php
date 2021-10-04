<?php

namespace Modules\State\Http\Controllers;

use Yajra\DataTables\DataTables;
use Modules\State\Entities\State;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\State\Services\StateService;
use Modules\State\Http\Requests\StateRequest;

class StateController extends Controller
{
    protected $state;

    protected $state_service;

    /**
     * Método Construtor
     *
     * @param State $state
     * @return void
     */
    public function __construct(
        State $state,
        StateService $state_service
    ) {
        $this->state = $state;
        $this->state_service = $state_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('state::index');
    }

    /**
     * Obtêm os dados para a tabela
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function dataTable()
    {
        $states = $this->state->with('country');

        return DataTables::of($states)
            ->addColumn("action", function ($state) {
                return $state->actionView();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Exibe a tela de cadastro
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::all();

        return view('state::create', compact('countries'));
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param Requests\StateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StateRequest $request)
    {
        $this->state_service->updateOrCreate($request->all());

        return redirect()
            ->route('state.index')
            ->with('message', 'Cadastro realizado com sucesso.');
    }

    /**
     * Exibe os dados
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $state = $this->state->with('country')
            ->findOrFail($id);

        return view('state::show', compact('state'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $state = $this->state->with('country')
            ->findOrFail($id);

        $countries = Country::orderBy('name')
            ->where('id', '!=', $state->country->id)
            ->get();

        return view('state::edit', compact('state', 'countries'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param Requests\StateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StateRequest $request, $id)
    {
        $state = $this->state->findOrFail($id);

        $this->state_service->updateOrCreate($request->all(), $state->id);

        return redirect()
            ->route('state.edit', $state->id)
            ->with('message', 'Atualização realizada com sucesso.');
    }

    /**
     * Exibe a tela para exclusão
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function confirmDelete($id)
    {
        $state = $this->state->findOrFail($id);

        return view('state::confirm-delete', compact('state'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $state = $this->state->findOrFail($id);

        $state->delete();

        return redirect()
            ->route('state.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
