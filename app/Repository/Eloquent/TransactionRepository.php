<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;
use App\Models\Transaction;
use App\Repository\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class TransactionRepository extends Repository implements TransactionRepositoryInterface
{
    protected Model $model;

    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }


      


    
}
