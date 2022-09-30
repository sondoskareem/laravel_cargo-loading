<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\LoadRepository;
use App\Load;
use App\Helper\Utilities;

class LoadController extends Controller
{

    private $LoadRepository;
    public function __construct()
    {
        $this->LoadRepository = new LoadRepository(new Load());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }

    /**
     * @OA\Post(
     *      path="/all/loads",
     *      operationId="get all loads",
     *      tags={"Load"},
     *      summary="get all loads",
     *      description="get all loads",
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="filter",
     *           type="array",
     *         @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={{"trailer_model","=",2} , {"employee_id","=","2"}},
     *
     *          ),
     *         @OA\Property(
     *           property="columns",
     *           type="array",
     *        @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={"id", "trailer_model", "employee_id"},
     *
     *          ),
     *         @OA\Property(
     *           property="sort",
     *           type="object",
     *           example={"column":"id","dir":"desc"},
     *          ),
     *         @OA\Property(
     *           property="skip",
     *           example="0",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="take",
     *           example="10",
     *           type="string",
     *          ),
     *         ),
     *       ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *   security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     * )
     */
    public function index(Request $request)
    {
            //Validation
            $request->validate([
                'skip' => 'Integer',
                'take' => 'required|Integer'
            ]);

            //Param
            $conditions = json_decode($request->filter, true);
            $columns = json_decode($request->columns, true);
            $sort = json_decode($request->sort);
            $skip = $request->skip;
            $take = $request->take;

            //Processing
            $response = $this->LoadRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }


      /**
     * @OA\Post(
     *      path="/loads",
     *      operationId="create loads",
     *      tags={"Load"},
     *      summary="create loads",
     *      description="create loads",
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="customer_id",
     *           example="",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="employee_id",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="po_load",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="load_rate",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="loaded_mile",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="load_type",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="trailer_type",
     *           type="string",
     *          ),
     *        @OA\Property(
     *           property="status",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="endorsements",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="number_of_stop",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="trailer_model",
     *           type="string",
     *          ),
     *         ),
     *       ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *   security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     * )
     */

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->LoadRepository->create($request);
        return Utilities::wrap($response);

    }


    /**
     * @OA\Post(
     *      path="/loads/{id}",
     *      operationId="get loads ByID",
     *      tags={"Load"},
     *      summary="Get loads By ID",
     *      description="Returns loads full info",
     *     @OA\Parameter(
     *          name="id",
     *          description="load ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     *     )
     */

    public function show($id)
    {
        $response = $this->LoadRepository->getById($id);
        return Utilities::wrap($response);
    }


/**
     * @OA\Post(
     *      path="/update/loads/{id}",
     *      operationId="update loads",
     *      tags={"Load"},
     *      summary="update loads",
     *      description="update loads",
     *      @OA\Parameter(
     *          name="id",
     *          description="load ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="customer_id",
     *           example="",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="employee_id",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="po_load",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="load_rate",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="loaded_mile",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="load_type",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="trailer_type",
     *           type="string",
     *          ),
     *        @OA\Property(
     *           property="status",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="endorsements",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="number_of_stop",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="trailer_model",
     *           type="string",
     *          ),
     *         ),
     *       ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *   security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     * )
     */

    public function update(Request $request,Load $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->LoadRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }
 /**
     * @OA\Post(
     *      path="/update/loads/{id}/status",
     *      operationId="update loads status",
     *      tags={"Load"},
     *      summary="update loads status ",
     *      description="update loads status",
     *      @OA\Parameter(
     *          name="id",
     *          description="load ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="status",
     *           example="",
     *           type="string",
     *          ),
     *         ),
     *       ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *   security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     * )
     */

    public function updateStatus(Request $request , Load $id)
    {
        request()->validate(['status' => 'required|string']);
        $response = $this->LoadRepository->updateStatus($id ,array('status' => $request->status));
        return Utilities::wrap($response);
    }

     /**
     * @OA\Delete(
     *      path="/delete/loads/{id}",
     *      operationId="delete loads",
     *      tags={"Load"},
     *      summary="delete loads ",
     *      description="delete loads",
     *     @OA\Parameter(
     *          name="id",
     *          description="load ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      security={
     *         {
     *             "api_key": {},
     *         }
     *     },
     *     )
     */
    public function destroy(Load $id)
    {
        $response = $this->LoadRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'customer_id' => $options.'required|exists:customers,id',
            'employee_id' => $options.'required|exists:employees,id',
            'po_load' => $options.'required|string',
            'load_rate' => 'required|integer',
            'loaded_mile' => $options.'required|integer',
            'load_type' => $options.'required|string',
            'trailer_type' => $options.'required|string',
            'endorsements' => $options.'required|boolean',
            'status' => $options.'required|string',
            'number_of_stop' => $options.'required|integer',
            'trailer_model' => $options.'required|string',
        ]);
    }
}

