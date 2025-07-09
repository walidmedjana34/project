<?php

namespace App\Observers;

use App\Models\Agency;

class AgencyObserver
{
    /**
     * Handle the Agency "created" event.
     */
    public function created(Agency $agency): void
    {
        //
    }

    /**
     * Handle the Agency "updated" event.
     */
    public function updated(Agency $agency): void
    {
        //
    }

    /**
     * Handle the Agency "deleted" event.
     */
    public function deleted(Agency $agency): void
    {
        //
    }

    /**
     * Handle the Agency "restored" event.
     */
    public function restored(Agency $agency): void
    {
        //
    }

    /**
     * Handle the Agency "force deleted" event.
     */
    public function forceDeleted(Agency $agency): void
    {
        //
    }
}
