<?php 
namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class Cors {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
       // ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
       // ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
       // ->header('Access-Control-Allow-Headers', 'Authorization,authorization');
    }
    

}
