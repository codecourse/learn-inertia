<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        if ($this->shouldRenderCustomErrorPage() && in_array($response->status(), [403, 404])) {
            return inertia()->render('Error', [
                'status' => $response->status()
            ])
                ->toResponse($request)
                ->setStatusCode($response->status());
        }

        return $response;
    }

    protected function shouldRenderCustomErrorPage()
    {
        if (!app()->environment(['local', 'testing'])) {
            return true;
        }

        if (config('app.custom_error_pages_enabled')) {
            return true;
        }

        return false;
    }
}
