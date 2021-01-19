<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            return $this->handleApiException($request, $exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * @param $request
     * @param Exception $exception
     * @return mixed
     */
    private function handleApiException($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    /**
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $message = null;
        if (method_exists($exception, 'getMessage')) {
            $message = $exception->getMessage();
        } elseif (property_exists($exception, 'original')) {
            $message = $exception->original['message'];
        }
        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = $message ?? 'Unauthorized';
                break;
            case 403:
                $response['message'] = $message ?? 'Forbidden';
                break;
            case 404:
                $response['message'] = $message ?? 'Not Found';
                break;
            case 405:
                $response['message'] = $message ?? 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $message;
                break;
        }

        if (config('app.debug')) {
            if (method_exists($exception, 'getTrace')) {
                $response['trace'] = $exception->getTrace();
            }
            if (method_exists($exception, 'getCode')) {
                $response['code'] = $exception->getCode();
            }
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
