<?php

namespace App\Exceptions;

use App\Facades\ApiOutputMaker;
use Exception;
use http\Env\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * Report or log an exception.
     *
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return $this->AuthorizationException();
        }
        return parent::render($request, $exception);
    }

    private function AuthorizationException()
    {
        return ApiOutputMaker::setOutput('Unauthorized')->setStatus(403)->getOutput();
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return ApiOutputMaker::setOutput('unauthenticated')->setStatus(401)->getOutput();
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return ApiOutputMaker::setOutput(
            [
                'error' => $exception->errors()
            ]
        )
            ->setStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY)
            ->getOutput();
    }
}
