<?php

namespace App\Exceptions;

use App\Models\LogError;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            //dd($exception);
            $user = auth()->user();
            LogError::create([
                'user_Id' => $user ? $user->id : 0,
                'message' => $exception->getMessage(),
                'exception' => get_class($exception),
                'line' => $exception->getline(),
                'trace' => array_map(function ($trace) {
                    unset($trace['args']);

                    return $trace;
                }, $exception->getTrace()),
                'method' => request()->getMethod(),
                'params' => request()->all(),
                'uri' => request()->getPathInfo(),
                'user_agent' => request()->userAgent(),
                'header' => request()->header->all(),
            ]);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response('授權失敗', 401);
    }
}
