<?php

namespace App\Http\Middleware;

use Closure;

class IsGerencia extends IsType
{
    public function getType()
    {
        return '7';
    }
}

