<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Helper\Utilities;
use App\Repository\CustomerRepository;

class CustomerController extends Controller
{
    private $CustomerRepository;
    public function __construct()
    {
        $this->CustomerRepository = new CustomerRepository(new Customer());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }


    /**
     * @OA\Post(
     *      path="/all/customers",
     *      operationId="get all customers",
     *      tags={"Customer"},
     *      summary="get all customers",
     *      description="get all customers",
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          @OA\Property(
     *           property="filter",
     *           type="array",
     *         @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={{"mc_number","=",2} , {"user_id","=","2"}},
     *
     *          ),
     *         @OA\Property(
     *           property="columns",
     *           type="array",
     *        @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={"id", "website", "mc_number"},
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
            $response = $this->CustomerRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }


         /**
     * @OA\Post(
     *      path="/customers",
     *      operationId="create customers",
     *      tags={"Customer"},
     *      summary="create customers",
     *      description="create customers",
     *      @OA\RequestBody(
     *      @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="name",
     *           example="",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="personal_phone",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="business_phone",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="address",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="date",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="note",
     *           type="string",
     *          ),
     *        @OA\Property(
     *           property="status",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="mc_number",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="dot_number",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="website",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="invoive_factoring_approvment",
     *           example=1,
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="invoice_mail",
     *           example=0,
     *           type="integer",
     *          ),
     *      @OA\Property(
     *           property="personal_fax",
     *           type="integer",
     *          ),
     *      @OA\Property(
     *           property="business_fax",
     *           type="integer",
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
        $response = $this->CustomerRepository->create($request->all());
        return Utilities::wrap($response);
    }



    /**
     * @OA\Post(
     *      path="/customers/{id}",
     *      operationId="get customers ByID",
     *      tags={"Customer"},
     *      summary="Get customers By ID",
     *      description="Returns customers full info",
     *     @OA\Parameter(
     *          name="id",
     *          description="customer ID",
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
        $response = $this->CustomerRepository->getById($id);
        return Utilities::wrap($response);
    }



    /**
     * @OA\Post(
     *      path="/update/customers/{id}",
     *      operationId="update customers",
     *      tags={"Customer"},
     *      summary="update customers",
     *      description="update customers",
     *  @OA\Parameter(
     *          name="id",
     *          description="Customer ID",
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
     *          property="name",
     *           example="",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="personal_phone",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="business_phone",
     *           type="integer",
     *          ),
     *         @OA\Property(
     *           property="address",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="date",
     *           type="string",
     *          ),
     *         @OA\Property(
     *           property="note",
     *           type="string",
     *          ),
     *        @OA\Property(
     *           property="status",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="mc_number",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="dot_number",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="website",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="invoive_factoring_approvment",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="invoice_mail",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="personal_fax",
     *           type="integer",
     *          ),
     *      @OA\Property(
     *           property="business_fax",
     *           type="integer",
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

    public function update(Request $request,Customer $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->CustomerRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }


    /**
     * @OA\Post(
     *      path="/update/customers/{id}/status",
     *      operationId="update customers status",
     *      tags={"Customer"},
     *      summary="update customers status ",
     *      description="update customers status",
     *     @OA\Parameter(
     *          name="id",
     *          description="customersID",
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
    public function updateStatus(Request $request , $id)
    {
        request()->validate(['status' => 'required|string']);
        $response = $this->CustomerRepository->updateStatus($id ,array('status' => $request->status));
        return Utilities::wrap($response);
    }

     /**
     * @OA\Delete(
     *      path="/delete/customers/{id}",
     *      operationId="delete customers",
     *      tags={"Customer"},
     *      summary="delete customers ",
     *      description="delete customers",
     *     @OA\Parameter(
     *          name="id",
     *          description="customer ID",
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
    public function destroy($id)
    {
        $response = $this->CustomerRepository->updateStatus($id ,array('is_deleted' => 1));
        return Utilities::wrap($response);
    }


    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'name' => $options.'required|string|unique:users',
            'email' => $options.'required|email|max:255|unique:users',
            'personal_phone' => $options.'required|integer|min:6',
            'business_phone' => $options.'required|integer|min:6',
            'address' => $options.'required|string',
            'date' => $options.'required|string',
            'status' => $options.'required|string',
            'note' => $options.'required|string',
            'mc_number' => $options.'required|string',
            'dot_number' => $options.'required|string',
            'website' => $options.'required|string',
            'invoive_factoring_approvment' => $options.'required|boolean',
            'invoice_mail' => $options.'required|boolean',
            'personal_fax' => $options.'required|integer',
            'business_fax' => $options.'required|integer',
        ]);
    }
}
