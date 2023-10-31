<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
        $this->renderable(function (NotFoundHttpException|ModelNotFoundException $ex) {
            if ($ex->getStatusCode() === Response::HTTP_NOT_FOUND) {
                return $this->error(Response::HTTP_NOT_FOUND, $ex->getMessage());
            }

            return $this->error($ex->getStatusCode(), $ex->getMessage());
        });

        $this->renderable(function (AccessDeniedHttpException|AuthorizationException $ex) {
            if ($ex->getStatusCode() === Response::HTTP_FORBIDDEN) {
                return $this->authorizationError($ex->getMessage());
            }

            return $this->error($ex->getStatusCode(), $ex->getMessage());
        });

        $this->renderable(function (NotFoundHttpException|ModelNotFoundException $ex) {
            if ($ex->getStatusCode() === Response::HTTP_NOT_FOUND) {
                return $this->error(Response::HTTP_NOT_FOUND, $ex->getMessage());
            }

            return $this->error($ex->getStatusCode(), $ex->getMessage());
        });

        $this->renderable(function (ValidationException $ex) {
            return $this->validationError($ex->errors());
        });

        $this->renderable(function (Throwable $ex) {
            Log::error($ex->getMessage(), $ex->getTrace());

            if (App::environment('local')) {
                $response = parent::prepareJsonResponse(request(), $ex);

                return $response->setData(
                    $this->serverError()->getOriginalContent()
                    + ['details' => $response->getData()]
                );
            }

            return $this->serverError();
        });
    }
}
