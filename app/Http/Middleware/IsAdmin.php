<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin extends IsType
{
    public function getType()
    {
        return '1';
    }
}