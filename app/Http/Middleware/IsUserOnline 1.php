<?php
/**
* Check user online.
*/

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
use Cache;
use Illuminate\Support\Facades\DB;

class IsUserOnline
{
/**
* Handle an incoming request.
*
* @param \Illuminate\Http\Request $request
* @param \Closure $next
*
* @return mixed
*/
public function handle($request, Closure $next)
{
// If user logged then create cache data on the 5 minutes.
if (Auth::check()) {
$user = Auth::user();

      DB::table("users")
              ->where("id", $user->id)
              ->update(["updated_at" => now()]);
//Auth::user()->update(['updated_at'=>date("Y-m-d H:i:s")]);
$expiresAt = Carbon::now()->addMinutes(5);
Cache::put('user-is-online-' . $user->id, true, $expiresAt);

}

return $next($request);
}
public function isOnline()
{
return Cache::has('user-is-online-' . $this->id);
}
}