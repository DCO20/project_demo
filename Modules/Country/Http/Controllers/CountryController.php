<?php

namespace Modules\Country\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Illuminate\Contracts\Support\Renderable;
use Modules\Country\Http\Requests\StoreUpdateRequest;

class CountryController extends Controller
{
    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('country::index');
    }

    /**
     * DataTables com ajax.
     *
     * @return json
     */
    public function dataTable()
    {
        $country = Country::get();

        return DataTables::of($country)
            ->addColumn("action", function ($country) {
                return '<div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="' . route('country.show', $country->id) . '">Ver</a>
                        <a class="dropdown-item" href="' . route('country.edit', $country->id) . '">Editar</a>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('country::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreUpdateRequest $request)
    {
        $this->country->create($request->all());

        return redirect()
            ->back()
            ->with('message', 'Cadastrado realizado com sucesso!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $country = $this->country->findOrFail($id);

        return view('country::show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $country = $this->country->findOrFail($id);

        return view('country::edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StoreUpdateRequest $request, $id)
    {
        $country = $this->country->findOrFail($id);

        $country->update($request->all());

        return redirect()
            ->route('country.edit', $country->id)
            ->with('message', 'Atualização realizada com sucesso.');
    }

    /**
     * Confirmar exclusão.
     *
     * @param int $id
     *
     * @return Renderable
     */
    public function confirmDelete()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
