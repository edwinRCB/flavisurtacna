<?php namespace flavisur\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class tipoDocente {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	public function handle($request, Closure $next)
	{
		if ($this->auth->user()->tipo == 'administrador' || $this->auth->user()->tipo == 'docente' || $this->auth->user()->tipo == 'secretaria')
		{
			return $next($request);
		}
		else
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('acceso');
			}
		}
	}

}
