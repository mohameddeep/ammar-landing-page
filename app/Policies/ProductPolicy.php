<?php

namespace App\Policies;

use App\Enums\UserTypeEnum;
use App\Models\Manager;
use App\Models\Product;
use App\Models\User;

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
    public function create(User $user): bool
    {
        if ($user->type == UserTypeEnum::Provider->value){
            return $user->activeSubscriptions()->exists();
        }else{
            return  $user->products()
                ->where('is_active', true)
                ->where('is_stopped', false)
                ->where('status', 'approved')
                ->exists();        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Manager $manager, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product)
    {
        return $product->user_id == $user->id;
    }


}
