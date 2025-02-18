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
    use Illuminate\Auth\Access\AuthorizationException;

    public function render($request, Throwable $exception)
    {
        // Menangani error 4xx dan 5xx untuk Web
        if ($request->isMethod('get') && !$request->wantsJson()) {
            return $this->handleWebException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function handleWebException($request, Throwable $exception)
    {
        // Handle 404 error (NotFoundHttpException)
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.generics', [
                'status_code' => 404,
                'message' => 'The page you are looking for could not be found.'
            ], 404);
        }

        // Handle 403 error (AuthorizationException)
        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.generics', [
                'status_code' => 403,
                'message' => 'You do not have permission to access this page.'
            ], 403);
        }

        // Handle other HttpExceptions (4xx and 5xx)
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            $message = $this->getErrorMessage($statusCode);

            // Handle error codes >= 500
            if ($statusCode >= 500) {
                return response()->view('errors.generics', [
                    'status_code' => $statusCode,
                    'message' => $message
                ], $statusCode);
            }

            // Handle other 4xx errors (e.g. 401, 403, etc.)
            return response()->view('errors.generics', [
                'status_code' => $statusCode,
                'message' => $message
            ], $statusCode);
        }

        return parent::render($request, $exception);
    }

    private function getErrorMessage($statusCode)
    {
        $messages = [
            400 => 'Bad Request. The server could not understand the request.',
            401 => 'Unauthorized. Please login to access this page.',
            403 => 'Forbidden. You do not have permission to view this page.',
            404 => 'Not Found. The page you requested could not be found.',
            500 => 'Internal Server Error. Something went wrong on our end.',
            502 => 'Bad Gateway. The server received an invalid response.',
            503 => 'Service Unavailable. The server is temporarily unavailable.',
            504 => 'Gateway Timeout. The server took too long to respond.',
        ];

        return $messages[$statusCode] ?? 'An unexpected error occurred.';
    }


}
