<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Models\Exceptions;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
      if($this->isHttpException($exception)){
          $statusCode = $exception->getStatusCode();
          switch ($statusCode) {
              case '400':
                  return redirect()->route('400');
                  break;
              case '404':
                  return redirect()->route('404');
                  break;
              case '500':
                  return redirect()->route('500');
                  break;
              case '503':
                  return redirect()->route('503');
                  break;
              default:
                  return parent::render($request, $exception);
                  break;
          }
        } else{
            if($exception!="") {
                $errorMessage = "";
                $errorMessage .= "<h3> Error : ".$exception->getMessage()."</h3>";
                $errorMessage .= "<h4> Code : ".$exception->getCode()."</h4>";
                $errorMessage .= "<h4> File : ".$exception->getFile()."</h4>";
                $errorMessage .= "<h4> Line : ".$exception->getLine()."</h4>";
                $errorMessage .= "<p> TraceAsString : ".$exception->getTraceAsString()."</p>";

                $Exceptions = New Exceptions;
                $Exceptions->sendException($errorMessage);
            }
            return parent::render($request, $exception);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
