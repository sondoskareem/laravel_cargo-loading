<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwaggerController extends Controller
{
     /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Cargexo Documentation",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Cargexo API documentation"
     * )
     * @OA\Tag(
     *     name="Auth User",
     *     description="API Endpoints of Auth User"
     * )
     * @OA\Tag(
     *     name="User",
     *     description="API Endpoints of User"
     * )
     *  @OA\Tag(
     *     name="Employee",
     *     description="API Endpoints of Employee"
     * )
     *  @OA\Tag(
     *     name="Customer",
     *     description="API Endpoints of Customer"
     * )
     *  @OA\Tag(
     *     name="Driver",
     *     description="API Endpoints of Driver"
     * )
     *  @OA\Tag(
     *     name="Load",
     *     description="API Endpoints of Load"
     * )
     * 
     * @OA\Tag(
     *     name="Company",
     *     description="API Endpoints of Company"
     * )
     * 
     * @OA\Tag(
     *     name="Factoring",
     *     description="API Endpoints of Factoring"
     * )
     * 
     * @OA\Tag(
     *     name="Equipment",
     *     description="API Endpoints of Equipment"
     * )
     * 
     * 
     * @OA\Tag(
     *     name="Position",
     *     description="API Endpoints of positions"
     * )
     * @OA\Tag(
     *     name="Stop",
     *     description="API Endpoints of stops"
     * )
     * 
     * @OA\Tag(
     *     name="Commodity",
     *     description="API Endpoints of Commodity"
     * )
     * 
     * @OA\Tag(
     *     name="Representative",
     *     description="API Endpoints of Representative"
     * )
     */
    
     /**
      * @OA\SecurityScheme(
      *   securityScheme="api_key",
      *   type="apiKey",
      *   in="header",
      *   name="Authorization"
      * )
      */
}
