<?php
namespace Modules\Suit\Database\factories;

use Modules\Product\Entities\Product;
use Modules\Suit\Entities\SuitProduct;
use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuitProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuitProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory()->create(),
            'product_id' => Product::factory()->create(),
            'purveyor_id' => Purveyor::factory()->create(),
            'price' => '100,00',
            'amount' => 1
        ];
    }
}
