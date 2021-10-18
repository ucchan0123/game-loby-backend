<?php

namespace Database\Factories;

use App\Models\Activation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActivationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activation::class;

    private $user_id = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () { return $this->user_id++; },
            'code' => Str::random(32),
            'completed_at' => now(),
        ];
    }
}
