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
        Product::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
    }
}
