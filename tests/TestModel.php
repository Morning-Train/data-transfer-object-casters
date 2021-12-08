<?php

namespace Morningtrain\DataTransferObjectCasters\Tests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use HasFactory;

    public $guarded = [];
}
