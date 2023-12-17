<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;
use Dotenv\Exception\ValidationException;
use Illuminate\Validation\ValidationData;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $this->renderable(function (Throwable $e, Request $request) {
            //return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        });
       
    }

   
}
