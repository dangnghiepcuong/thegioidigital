<?php

namespace App\Enums;
use App\Support\Traits\EnumAccessTrait;


final class OperationEnum
{
    use EnumAccessTrait;

    const CREATE = 'create';
    const READ = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const WRITE = 'write';
}
