<?php

namespace App\Jobs;

use App\Mail\LoanConfirmationMail;
use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLoanConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Loan $loan) {}

    public function handle(): void
    {
        Mail::to($this->loan->member->email)
            ->send(new LoanConfirmationMail($this->loan));
    }
}