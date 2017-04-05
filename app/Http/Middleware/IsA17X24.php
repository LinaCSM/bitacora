<?php

namespace App\Http\Middleware;

use Closure;

class IsA17X24  extends IsType
{
    public function getType()
    {
        return '3';
    }
}