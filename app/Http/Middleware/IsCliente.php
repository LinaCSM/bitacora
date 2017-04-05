<?php

namespace App\Http\Middleware;

use Closure;

class IsCliente  extends IsType
{
    public function getType()
    {
        return '8';
    }
}
