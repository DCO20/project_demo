<?php
namespace Modules\Client\Database\factories;

use Modules\Client\Entities\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'date_birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'genre' => $this->faker->randomElement(['F', 'M']),
            'active' => true,
            'price' => '100.00'
        ];
    }
}
