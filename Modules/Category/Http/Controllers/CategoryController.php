<?php

namespace Modules\Category\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Services\CategoryService;
use Modules\Category\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $category;

    protected $category_service;

    /**
     * Método Construtor
     *
     * @param category $category
     * @return void
     */
    public function __construct(
        Category $category,
        CategoryService $category_service
    ) {
        $this->category = $category;
        $this->category_service = $category_service;
    }

    /**
     * Exibe a tela inicial com a listagem de dados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Obtêm os dados para a tabela
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function dataTable()
    {
        $categories = $this->category->query();

        return DataTables::of($categories)
            ->editColumn("active", function ($category) {
                return $category->formatted_active;
            })
            ->addColumn("action", function ($category) {
                return $category->actionView();
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
        return view('category::create');
    }

    /**
     * Cadastra e retorna para a tela inicial
     *
     * @param Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->category_service->updateOrCreate($request->all());

        return redirect()
            ->route('category.index')
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
        $category = $this->category->findOrFail($id);

        return view('category::show', compact('category'));
    }

    /**
     * Exibe os dados para edição
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);

        return view('category::edit', compact('category'));
    }

    /**
     * Atualiza e retorna para a tela de edição
     *
     * @param Requests\CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->category->findOrFail($id);

        $this->category_service->updateOrCreate($request->all(), $category->id);

        return redirect()
            ->route('category.edit', $category->id)
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
        $category = $this->category->findOrFail($id);

        return view('category::confirm-delete', compact('category'));
    }

    /**
     * Exclui e retorna para a tela inicial
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->category->findOrFail($id);

        $this->category_service->removeData($category);

        return redirect()
            ->route('category.index')
            ->with('message', 'Exclusão realizada com sucesso.');
    }
}
