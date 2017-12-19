<?php

namespace shiraishi\Policies;

use shiraishi\User;
use shiraishi\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param \shiraishi\User    $user
     * @param \shiraishi\Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can create products.
     *
     * @param \shiraishi\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param \shiraishi\User    $user
     * @param \shiraishi\Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param \shiraishi\User    $user
     * @param \shiraishi\Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }
}
