<?php

use Morningtrain\DataTransferObjectCasters\Casters\ModelCaster;
use Morningtrain\DataTransferObjectCasters\Models\TestModel;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('casts to model from primary key', function () {
    $model = TestModel::factory()->create(['name' => 'Clark']);

    $DTO = new class (['model' => $model->getKey()]) extends DataTransferObject {
        #[CastWith(ModelCaster::class, class: TestModel::class)]
        public TestModel $model;
    };

    expect($DTO->model)
        ->toBeInstanceOf(TestModel::class)
        ->id->toBe($model->id);
});

it('casts to model from specified column', function () {
    $model = TestModel::factory()->create(['name' => 'Clark']);

    $DTO = new class (['model' => 'Clark']) extends DataTransferObject {
        #[CastWith(ModelCaster::class, class: TestModel::class, by: 'name')]
        public TestModel $model;
    };

    expect($DTO->model)
        ->toBeInstanceOf(TestModel::class)
        ->id->toBe($model->id);
});

it('casts to model value from specified column', function () {
    $model = TestModel::factory()->create(['name' => 'Clark']);

    $DTO = new class (['modelName' => $model->getKey()]) extends DataTransferObject {
        #[CastWith(ModelCaster::class, class: TestModel::class, column: 'name')]
        public string $modelName;
    };

    expect($DTO->modelName)
        ->toBeString()
        ->toBe('Clark');
});
