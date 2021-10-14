<?php

namespace Modules\Product\Services;

use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;

class ProductService
{
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
            $product =Product::updateOrCreate(['id' => $id], $request);

            $product->categories()->sync($request['categories'] ?? []);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }


    /**
     * Exclui e retorna a tela inicial
     * @param Modules\Product\Entities\Product $product
     * @param int|null $id
     *
     * @return void
     */
    public function removeData($product)
    {
        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500);
        }
    }
}
