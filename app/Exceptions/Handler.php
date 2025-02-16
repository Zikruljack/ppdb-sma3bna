<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * Render the exception as an HTTP response.
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Validation\ValidationException::class,
        // Add other exceptions here as needed
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof TokenMismatchException) {
            Alert::warning('Sesi Kedaluwarsa', 'Anda akan dialihkan ke login.');
            return redirect('/');
        }
        // Check if the request expects a JSON response (API)
        if ($request->wantsJson()) {
            return $this->handleApiException($request, $exception);
        }


        // For non-API requests (web requests), customize error pages for 4xx and 5xx
        return $this->handleWebException($request, $exception);
    }

    protected function handleApiException($request, Throwable $exception)
    {
        $response = [
            'success' => false,
            'message' => $exception->getMessage(),
        ];

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return new JsonResponse($response, 404);
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return new JsonResponse($response, 401);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $response['errors'] = $exception->errors();
            return new JsonResponse($response, 422);
        }

        return new JsonResponse($response, 500);
    }

    // Custom method to handle web exceptions and return custom error pages
    protected function handleWebException($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            // Render custom 404 page
            return response()->view('errors.generics', [], 404);
        }

        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();

            if ($statusCode >= 500) {
                // Render custom 500 page
                return response()->view('errors.generics', [], $statusCode);
            }

            // For other 4xx errors, render a general error page or specific ones like 403, 401, etc.
            if ($statusCode == 403) {
                return response()->view('errors.generics', [], $statusCode);
            }

            if ($statusCode == 401) {
                return response()->view('errors.generics', [], $statusCode);
            }
        }

        // Fallback to the default parent method if no custom handling is found
        return parent::render($request, $exception);
    }

}
