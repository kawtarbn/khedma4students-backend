<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoadEmailConfig
{
    public function handle(Request $request, Closure $next)
    {
        // Force load email configuration for all requests
        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => 'smtp.gmail.com',
            'mail.mailers.smtp.port' => 587,
            'mail.mailers.smtp.username' => 'khedma4students@gmail.com',
            'mail.mailers.smtp.password' => 'vwgguxviwzyhcqck',
            'mail.mailers.smtp.encryption' => 'tls',
            'mail.from.address' => 'khedma4students@gmail.com',
            'mail.from.name' => 'Khedma4Students',
        ]);
        
        return $next($request);
    }
}
