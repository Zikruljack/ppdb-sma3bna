<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request, Throwable $exception): Response
    {
        $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        return response()->view('errors.generic', [
            'code' => $status,
            'message' => $exception->getMessage() ?: 'Terjadi kesalahan pada server'
        ], $status);
    }
}
