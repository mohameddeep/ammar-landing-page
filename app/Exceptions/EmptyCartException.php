<?php

namespace App\Exceptions;

use App\Http\Helpers\Http;
use Exception;
use function App\Http\Helpers\responseFail;

class EmptyCartException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('messages.empty_cart'), Http::BAD_REQUEST);
    }
}
