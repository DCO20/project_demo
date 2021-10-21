<?php

namespace Modules\Purveyor\Database\factories;

use Modules\Purveyor\Entities\Purveyor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurveyorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purveyor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cnpj' => '22222222222222',
            'active' => true
        ];
    }
}
