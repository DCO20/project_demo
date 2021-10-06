<?php

namespace Modules\Product\Services;

use Modules\Product\Entities\Product;

class ProductService
{
    /**
     * Método que cria um produto
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        $product = Product::updateOrCreate(['id' => $id], $request);

        $product->categories()->sync($request['categories'] ?? '');

        return $product;
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
        $product->delete();
    }
}
