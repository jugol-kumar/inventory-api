<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     * @param User $user
     */
    public function created(User $user): void
    {
        $user->user_id = Auth::id();
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     * @param User $user
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     * @param User $user
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     * @param User $user
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     * @param User $user
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
