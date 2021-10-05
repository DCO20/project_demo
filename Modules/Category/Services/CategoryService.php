<?php

namespace Modules\Category\Services;

use Modules\Category\Entities\Category;

class CategoryService
{
    /**
     * Método que cria uma categoria
     * @param array $request
     * @param int|null $id
     *
     * @return void
     */
    public function updateOrCreate($request, $id = null)
    {
        Category::updateOrCreate(
            [
                'id' => $id
            ],
            $request
        );
    }
}
