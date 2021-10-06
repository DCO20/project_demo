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
     * Método que deleta um produto
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function delete($id)
    {
        Product::destroy(['id' => $id]);
    }
}
