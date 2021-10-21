<?php
namespace Modules\Category\Database\factories;

use Modules\Category\Entities\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class CategoryProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'product_id' => Product::factory()->create()->id
        ];
    }
}
