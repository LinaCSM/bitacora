<?php

namespace App\Http\Middleware;

use Closure;

class IsA1_WG extends IsType
{
    public function getType()
    {
        return '6';
    }
}