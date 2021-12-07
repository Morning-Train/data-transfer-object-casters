<?php

namespace Morningtrain\DataTransferObjectCasters\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Morningtrain\DataTransferObjectCasters\Models\TestModel;

class TestModelFactory extends Factory
{
    protected $model = TestModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
