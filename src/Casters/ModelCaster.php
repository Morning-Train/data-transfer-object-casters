<?php

namespace Morningtrain\DataTransferObjectCasters\Casters;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Spatie\DataTransferObject\Caster;

class ModelCaster implements Caster
{
    public function __construct(
        array $types,
        public string $class,
        public ?string $by = null,
        public ?string $column = null
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

        return $this->column ? $model->{$this->column} : $model;
    }

    private function getModel(string|int $key): ?Model
    {
        $modelReflection = new ReflectionClass($this->class);

        $instance = $modelReflection->newInstanceWithoutConstructor();

        return $instance
            ->query()
            ->where($this->by ?? $instance->getKeyName(), $key)
            ->first();
    }
}
