<?php

namespace App\Http\Middleware;

use Closure;

class IsA17X24N extends IsType
{
    public function getType()
    {
        return '4';
    }
}