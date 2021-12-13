<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Spatie\DataTransferObject\Caster;

class ModelCaster implements Caster
{
    public function __construct(
        array $types,
        public string $model,
        public ?string $findBy = null,
        public ?string $select = null
    ) {
    }

    public function cast(mixed $value): mixed
    {
        if ($value instanceof Model) {
            return $value;
        }

        if (! is_int($value) && ! is_string($value)) {
            return null;
        }

        $model = $this->getModel($value);

        if ($model === null) {
            return null;
        }

        return $this->select ? $model->{$this->select} : $model;
    }

    private function getModel(string|int $key): ?Model
    {
        $modelReflection = new ReflectionClass($this->model);

        $instance = $modelReflection->newInstanceWithoutConstructor();

        return $instance
            ->query()
            ->where($this->findBy ?? $instance->getKeyName(), $key)
            ->first();
    }
}
