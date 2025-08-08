<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class RateLimitBlocker
{
    const MAX_REQUESTS = 1;
    const TIME_WINDOW = 1;
    const BLOCK_TIME = 3600;

    public function handle(Request $request, Closure $next)
    {
        try {
            $userId = $request->user()?->id ?? $request->ip();
            $rateKey = "rate:$userId";
            $blockKey = "blocked:$userId";

            if (Redis::exists($blockKey)) {
                return response()->json([
                    'message' => 'فعالیت شما مشکوک تشخیص داده شد چنانچه به مسدود شدن اکانت خود اعتراض دارید با پشتیبانی تماس بگیرید'
                ], 429);
            }

            $requestCount = Redis::incr($rateKey);

            if ($requestCount == 1) {
                Redis::expire($rateKey, self::TIME_WINDOW);
            }

            if ($requestCount > self::MAX_REQUESTS) {
                Redis::setex($blockKey, self::BLOCK_TIME, 1);
                Redis::del($rateKey);
                return response()->json([
                    'message' => 'فعالیت شما مشکوک تشخیص داده شد چنانچه به مسدود شدن اکانت خود اعتراض دارید با پشتیبانی تماس بگیرید'
                ], 429);
            }

            return $next($request);

        } catch (\Exception $e) {
            \Log::error('RateLimitBlocker error: ' . $e->getMessage());
            return $next($request);
        }
    }
}