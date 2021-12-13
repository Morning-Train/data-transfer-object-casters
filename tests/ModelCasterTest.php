<?php

use Morningtrain\DataTransferObjectCasters\Casters\ModelCaster;
use Morningtrain\DataTransferObjectCasters\Tests\TestModel;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

it('casts to model from primary key', function () {
    $model = TestModel::create(['name' => 'Clark']);

    $DTO = new class (['model' => $model->getKey()]) extends DataTransferObject {
        #[CastWith(ModelCaster::class, model: TestModel::class)]
        public TestModel $model;
    };

    expect($DTO->model)
        ->toBeInstanceOf(TestModel::class)
        ->id->toBe($model->id);
});

it('casts to model from specified column', function () {
    $model = TestModel::create(['name' => 'Clark']);

    $DTO = new class (['model' => 'Clark']) extends DataTransferObject {
        #[CastWith(ModelCaster::class, model: TestModel::class, findBy: 'name')]
        public TestModel $model;
    };

    expect($DTO->model)
        ->toBeInstanceOf(TestModel::class)
        ->id->toBe($model->id);
});

it('casts to model value from specified column', function () {
    $model = TestModel::create(['name' => 'Clark']);

    $DTO = new class (['modelName' => $model->getKey()]) extends DataTransferObject {
        #[CastWith(ModelCaster::class, model: TestModel::class, select: 'name')]
        public string $modelName;
    };

    expect($DTO->modelName)
        ->toBeString()
        ->toBe('Clark');
});
