<?php

namespace App\Http\Services\Dashboard;

use App\Http\Helpers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

abstract class BaseService
{
    protected $repository;
    protected $transactionRepository;
    protected string $type;
    protected string $viewPath;

    public function __construct($repository,$transactionRepository, string $type, string $viewPath)
    {
        $this->repository = $repository;
        $this->transactionRepository = $transactionRepository;
        $this->type = $type;
        $this->viewPath = $viewPath;
    }

    public function index($request)
    {
        $items = $this->repository->paginateWithQuery(function ($query) use ($request) {
            $query->where('type', $this->type);

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
                });
            }
        }, 20);

        return view("{$this->viewPath}.index", [$this->type . 's' => $items]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create");
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['type'] = $this->type;

            $this->repository->create($data);
            DB::commit();

            return redirect()->route($this->type . 's.index')
                ->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function show($id)
    {
        $item = $this->repository->getById($id);
        return view("{$this->viewPath}.show", [$this->type => $item]);
    }

    public function edit($id)
    {
        $item = $this->repository->getById($id);
        return view("{$this->viewPath}.edit", [$this->type => $item]);
    }

    public function update($request, $id)
    {
        try {
            $this->repository->update($id, $request->validated());
            return redirect()->route($this->type . 's.index')
                ->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }
            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
        } catch (\Exception $e) {
            return responseFail(Http::BAD_REQUEST, [
                'error' => $e->getMessage(),
                __('messages.Something went wrong')
            ]);
        }
    }


     public function transactions($id)
{
    $user = $this->repository->getById($id);

    $transactions = $this->repository->transactions($id);

    return view("{$this->viewPath}.transactions", [
        'user' => $user,
        'transactions' => $transactions
    ]);
}


 public function addTransaction($id, $request)
{
    try {
        DB::beginTransaction();

        $user = $this->repository->getById($id);
        $data = $request->validated();

        $transaction = $user->transactions()->create($data);

        if ($data['type'] === 'increase') {
            $user->increment('wallet_balance', $data['amount']);
        } elseif ($data['type'] === 'decrease') {
            $user->decrement('wallet_balance', $data['amount']);
        }

        DB::commit();
        return redirect()->back()->with( __('messages.created_successfully'));
    } catch (\Exception $e) {
        DB::rollBack();
        return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage()]);
    }
}



public function deleteTransaction($transactionId)
{
    try {
        DB::beginTransaction();

        
        $transaction =$this->transactionRepository->getById($transactionId);
        $user = $this->repository->getById($transaction->user_id);

      

        $transaction->delete();

        DB::commit();

       redirect()->back()->with( __('messages.deleted_successfully'));

    } catch (\Exception $e) {
        DB::rollBack();
        return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage()]);
    }
}

}
