<?php

namespace Modules\Location\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\Location\Entities\Location;
use Modules\Location\Services\LocationService;
use Modules\Location\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    protected $location;

    protected $location_service;

    /**
     * Método Construtor
     *
     * @param location $location
     * @return void
     */
    public function __construct(
        Location $location,
        LocationService $location_service
    ) {
        $this->location = $location;
        $this->location_service = $location_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('location::index');
    }

    /**
     * Obtêm os dados para a tabela
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function dataTable()
    {
        $locations = $this->location->query();

        return DataTables::of($locations)
            ->addColumn("country", function ($location) {
                return $location->country->name;
            })
            ->addColumn("action", function ($location) {
                return $location->actionView();
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

        return view('location::create', compact('countries'));
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param Requests\locationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(locationRequest $request)
    {
        $this->location_service->updateOrCreate($request->all());

        return redirect()
            ->route('location.index')
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
        $location = $this->location->with('country')
            ->findOrFail($id);

        return view('location::show', compact('location'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $location = $this->location->with('country')
            ->findOrFail($id);

        $countries = Country::orderBy('name')
            ->where('id', '!=', $location->country->id)
            ->get();

        return view('location::edit', compact('location', 'countries'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param Requests\locationRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LocationRequest $request, $id)
    {
        $location = $this->location->findOrFail($id);

        $this->location_service->updateOrCreate($request->all(), $location->id);

        return redirect()
            ->route('location.edit', $location->id)
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
        $location = $this->location->with('country')
            ->findOrFail($id);

        return view('location::confirm-delete', compact('location'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $location = $this->location->findOrFail($id);

        $location->delete();

        return redirect()
            ->route('location.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
