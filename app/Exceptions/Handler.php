<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{


    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

//     public function render($request, Throwable $exception)
// {
//     if ($exception instanceof AuthenticationException) {
//         return response()->json(["error"=>30001, "message"=>"authenticate failed"]);
//     }
//     return parent::render($request, $exception);
// }

}
