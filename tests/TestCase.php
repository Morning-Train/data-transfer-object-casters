<?php

namespace Morningtrain\DataTransferObjectCasters\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Morningtrain\DataTransferObjectCasters\DataTransferObjectCastersServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Morningtrain\\DataTransferObjectCasters\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DataTransferObjectCastersServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_test_models_table.php.stub';
        $migration->up();
    }
}
