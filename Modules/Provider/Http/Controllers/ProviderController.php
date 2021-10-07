<?php

namespace Modules\Provider\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Provider\Entities\Provider;
use Modules\Provider\Services\ProviderService;
use Modules\Provider\Http\Requests\ProviderRequest;

class ProviderController extends Controller
{
    protected $provider;

    protected $provider_service;

    /**
     * Método Construtor
     *
     * @param provider $provider
     * @return void
     */
    public function __construct(
        Provider $provider,
        ProviderService $provider_service
    ) {
        $this->provider = $provider;
        $this->provider_service = $provider_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('provider::index');
    }

    /**
     * Obtêm os dados para a tabela
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function dataTable()
    {
        $providers = $this->provider->query();

        return DataTables::of($providers)
            ->editColumn("active", function ($provider) {
                return $provider->formatted_active;
            })
            ->addColumn("action", function ($provider) {
                return $provider->actionView();
            })
            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    /**
     * Exibe a tela de cadastro
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('provider::create');
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param Requests\ProviderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProviderRequest $request)
    {
        $this->provider_service->updateOrCreate($request->all());

        return redirect()
            ->route('provider.index')
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
        $provider = $this->provider->with('address')
            ->findOrFail($id);

        return view('provider::show', compact('provider'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $provider = $this->provider->with('address')
            ->findOrFail($id);

        return view('provider::edit', compact('provider'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param Requests\ProviderRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProviderRequest $request, $id)
    {
        $provider = $this->provider->findOrFail($id);

        $this->provider_service->updateOrCreate($request->all(), $provider->id);

        return redirect()
            ->route('provider.edit', $provider->id)
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
        $provider = $this->provider->findOrFail($id);

        return view('provider::confirm-delete', compact('provider'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $provider = $this->provider->findOrFail($id);

        $this->provider_service->removeData($provider);

        return redirect()
            ->route('provider.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
