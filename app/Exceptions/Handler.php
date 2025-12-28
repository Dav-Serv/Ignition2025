<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        // Jika file upload terlalu besar, tampilkan error validasi, bukan 500
        if ($exception instanceof PostTooLargeException) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'cv' => 'Ukuran file terlalu besar. Maksimal 2 MB.'
                ]);
        }

        return parent::render($request, $exception);
    }
}
