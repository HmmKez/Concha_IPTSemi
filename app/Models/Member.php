<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'membership_start',
        'membership_end',
    ];

    public function loans(){
        return $this->hasMany(Loan::class);
    }
}
