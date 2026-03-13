<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'loan_date',
        'due_date',
        'returned_date',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loanItems()
    {
        return $this->hasMany(LoanItem::class);
    }
}
