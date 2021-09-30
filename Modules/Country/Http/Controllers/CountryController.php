<?php

namespace Modules\Country\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Country\Entities\Country;
use Modules\Country\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

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

    public function create()
    {
        return view('country::create');
    }

    public function store(CountryRequest $request)
    {
        $this->country->create($request->all());

        return redirect()
            ->route('country.index')
            ->with('message', 'Cadastrado realizado com sucesso!');
    }

    public function show($id)
    {
        $country = $this->country->findOrFail($id);

        return view('country::show', compact('country'));
    }

    public function edit($id)
    {
        $country = $this->country->findOrFail($id);

        return view('country::edit', compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        $country = $this->country->findOrFail($id);

        $country->update($request->all());

        return redirect()
            ->route('country.edit', $country->id)
            ->with('message', 'Atualização realizada com sucesso.');
    }

    public function confirmDelete()
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
