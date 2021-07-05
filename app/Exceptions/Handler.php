<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

// !-----------------------------------------------------------------------------------------------
// OJO CON ESTOS IMPORT, funciona a nivel local pero ver si funciona en Heroku
// !-----------------------------------------------------------------------------------------------
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

//
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        /* Tanto poner la funcion dentro de register como usar la función render que está comentada debajo son lo mismo.
        Ver si hay una forma correcta por defecto o da lo mismo.
        */

        /*En caso de acceder a una ruta inválida de la api devuelve un mensaje de error en JSON */
        /*$this->renderable(function (NotFoundHttpException $e, $request) {
            if( $request->is('api/*')){
                if ($request->wantsJson()) {
                    return response()->json(['message' => 'Not Found!'], 404);
                }
            }
        });*/
        $this->renderable(function (Throwable $e, $request) {
            if( $request->is('api/*')){
                /*En caso de acceder a una ruta inválida de la api devuelve un mensaje de error en JSON */
                if (($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) && $request->wantsJson()) {
                    return response()->json(['error' => 'Not Found!'], 404);
                }
                if ($e instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
                    return response()->json(['error' => 'Método no soportado, asegúrese de que la request es de tipo correcto'.$request->method()], 405);
                }
                //return response()->json(['error' => 'error no manejado'], 500);
            }
        });
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // De esta forma también se pueden mostrar los errores.
    /*public function render($request, Throwable $exception){
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json(['error' => 'Not Found!'], 404);
        }
        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {
            return response()->json(['error' => 'Not Found!'], 404);
        }
        return parent::render($request, $exception);
    }*/
}
