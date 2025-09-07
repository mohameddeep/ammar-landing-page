<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Auth;

final class AuthMobileService extends AuthService
{
    public static function platform(): string
    {
        return 'mobile';
    }

    public function whatIsMyPlatform(): string // will be invoked if the request came from mobile endpoints
    {
        return 'platform: mobile!';
    }
}
