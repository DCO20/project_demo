<?php
namespace Modules\Suit\Database\factories;

use Modules\Suit\Entities\Suit;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'suit_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'status' => $this->faker->randomElement(['Finished', 'Pending']),
            'note' => $this->faker->paragraph()
        ];
    }
}
