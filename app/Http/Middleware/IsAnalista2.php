<?php

namespace App\Http\Middleware;

use Closure;

class IsAnalista2 extends IsType
{
    public function getType()
    {
        return '2';
    }
}
