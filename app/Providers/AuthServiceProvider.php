<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Reimbursement::class => ReimbursementPolicy::class,
    ];

    public function boot(): void
    {
       
    }
}
