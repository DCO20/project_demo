<?php

namespace Modules\Category\Services;

use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class CategoryService
{
    /*--------------------------------------------------------------------------
    | Main Function
    |--------------------------------------------------------------------------
    |
    | Métodos principais do CRUD.
    | Define os métodos e as regras de negócio relacionadas ao CRUD.
    |
    */

    /**
     * Cadastra ou atualiza o registro
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        DB::beginTransaction();

        try {

            Category::updateOrCreate(
                [
                    'id' => $id
                ], $request);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }

    /**
     * Exclui e retorna a tela inicial
     * @param Modules\Category\Entities\Category $category
     *
     * @return void
     */
    public function removeData($category)
    {
        DB::beginTransaction();

        try {
            $category->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }
}
