<?php namespace App\Http\Middleware;


use Closure;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

abstract class IsType {


    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    abstract public function getType();


    public function handle($request, Closure $next)
    {
        $tipoUsuario = \Auth::user()->FK_Tipo;
        if ($this->auth->user()->FK_Tipo != $this->getType())
        {
            $this->auth->logout();

            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            } 
            else 
            {
                Session::flash('message-error', 'No Tiene Permiso Para El Recurso Solicitado');
                return redirect()->to('/');
            }
        }
        return $next($request);
    }

}

