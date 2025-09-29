<?php

namespace App\Http\Services\Api\V1\Wallet;

use App\Http\Resources\V1\Transaction\TransactionResource;
use function App\Http\Helpers\responseSuccess;

class WalletService
{
    public function index()
    {
        $user = auth('api')->user();
        $balance = $user->wallet_balance;
        $transactions = $user->transactions()->orderBy('created_at', 'desc')->get();
        $data = [
            'balance' => $balance,
            'transactions' => TransactionResource::collection($transactions)
        ];

        return responseSuccess(data: $data);
    }
}
