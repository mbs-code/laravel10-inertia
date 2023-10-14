<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

use function PHPSTORM_META\map;

class AutoTransaction
{
    /**
     * transactionを貼るメソッド名
     *
     * @var array<int, string>
     */
    protected $methods = [
        'POST',
        'PUT',
        'DELETE',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $method = Str::upper($request->getMethod());
        if (Arr::exists($this->methods, $method)) {
            DB::beginTransaction();

            $response = $next($request);

            if (data_get($response, 'exception')) {
                DB::rollBack();
            } else {
                DB::commit();
            }

            return $response;
        } else {
            return $next($request);
        }
    }
}
