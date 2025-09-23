<?php

namespace App\Exceptions;

use Inertia\Inertia;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Check for 404 error
        if ($exception instanceof NotFoundHttpException) {
            // If using Inertia
            return Inertia::render('Errors/NotFound') // Vue component
                ->toResponse($request)
                ->setStatusCode(404);
        }

        return parent::render($request, $exception);
    }
}
