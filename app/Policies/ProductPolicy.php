<?php


namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Product $product)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Product $product)
    {
        return $product->user_id == $user->id;
    }

    public function delete(User $user, Product $product)
    {
        return $product->user_id == $user->id;
    }
}
