<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\OpenApi(
 *     @OA\Info(
 *          version="1.0.0",
 *          title="API Crud Test",
 *          description="Здесь описаны все роуты."
 *     )
 * )
 * @OA\Server(
 *     description="Laravel Swagger API server",
 *     url="http://localhost:8000/api",
 *     ),
 *)
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
