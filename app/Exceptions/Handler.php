<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Http\Response;

use App\Traits\ResponseBuilder;

class Handler extends ExceptionHandler
{
    use ResponseBuilder;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd(get_class($exception));
        if ($exception instanceof NotFoundHttpException) {
            $message = "404 Not Found";
            return $this->error($message, Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(last(explode("\\", $exception->getModel())));
            $message = "this {$model} does not exists";
            return $this->error($message, Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof AuthorizationException) {
            $message = $exception->getMessage();
            return $this->error($message, Response::HTTP_FORBIDDEN);
        }
        if ($exception instanceof AuthenticationException) {
            $message = $exception->getMessage();
            return $this->error($message, Response::HTTP_UNAUTHORIZED);
        }
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            return $this->error($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $exception);
    }
}
