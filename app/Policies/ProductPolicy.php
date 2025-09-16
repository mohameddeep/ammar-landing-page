<?php

namespace App\Policies;

use App\Models\Manager;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Manager $manager): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Manager $manager, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Manager $manager): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Manager $manager, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product)
    {
        return $product->user_id == $user->id ?
            Response::allow() :
            Response::deny(__('messages.unauthorized'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Manager $manager, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Manager $manager, Product $product): bool
    {
        return false;
    }
}
