<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Zibal\ZibalService setMerchantId(string $merchantId)
 * @method static \App\Services\Zibal\ZibalService setSandbox(bool $sandbox)
 * @method static array request(int $amount, string $callbackUrl, string $description = null, string $orderId = null)
 * @method static array verify(string $trackId)
 * @method static string getRedirectUrl(string $trackId)
 *
 * @see \App\Services\Zibal\ZibalService
 */
class Zibal extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zibal';
    }
}
