<?php

namespace App\Observers;

use App\Models\LoanItem;

class LoanItemObserver
{
    /**
     * Handle the LoanItem "created" event.
     */
    public function created(LoanItem $loanItem): void
    {
        $loanItem->book->decrement('quantity', $loanItem->quantity);
    }

    /**
     * Handle the LoanItem "updated" event.
     */
    public function updated(LoanItem $loanItem): void
    {
        //
    }

    /**
     * Handle the LoanItem "deleted" event.
     */
    public function deleted(LoanItem $loanItem): void
    {
        $loanItem->book->increment('quantity', $loanItem->quantity);
    }

    /**
     * Handle the LoanItem "restored" event.
     */
    public function restored(LoanItem $loanItem): void
    {
        //
    }

    /**
     * Handle the LoanItem "force deleted" event.
     */
    public function forceDeleted(LoanItem $loanItem): void
    {
        //
    }
}
