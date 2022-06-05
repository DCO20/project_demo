<?php
namespace Modules\Category\Database\factories;

use Modules\Category\Entities\Category;
use Modules\Purveyor\Entities\Purveyor;
use Modules\Category\Entities\CategoryPurveyor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryPurveyorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryPurveyor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory()->create(),
            'purveyor_id' => Purveyor::factory()->create()
        ];
    }
}
