<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\EmployeeRepository;
use App\Employee;
use App\Helper\Utilities;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{

    private $EmployeeRepository;
    public function __construct()
    {
        $this->EmployeeRepository = new EmployeeRepository(new Employee());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();

    }

    /**
     * @OA\Post(
     *      path="/all/employees",
     *      operationId="get all employees",
     *      tags={"Employee"},
     *      summary="get all employees",
     *      description="get all Employee",
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
     *          example={{"education","=","any"} , {"education","=","any"}},
     *
     *          ),
     *         @OA\Property(
     *           property="columns",
     *           type="array",
     *        @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={"id", "pay_rate_per_hour", "education"},
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
            $response = $this->EmployeeRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);

    }

  /**
     * @OA\Post(
     *      path="/employees",
     *      operationId="create employees",
     *      tags={"Employee"},
     *      summary="create employees",
     *      description="create Employee",
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
     *           property="position_id",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="company_id",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="birth",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="pay_rate_per_hour",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="education",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="profile_image",
     *           type="file",
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
        $response = $this->EmployeeRepository->create($request);
        return Utilities::wrap($response);

    }

     /**
     * @OA\Post(
     *      path="/employees/{id}",
     *      operationId="getEmployeeByID",
     *      tags={"Employee"},
     *      summary="Get employee By ID",
     *      description="Returns employee full info",
     *     @OA\Parameter(
     *          name="id",
     *          description="employeeID",
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
        //  (Gate::authorize('allow_admin', $this->user))

        $response = $this->EmployeeRepository->getById($id);
        return Utilities::wrap($response);
    }

    /**
     * @OA\Post(
     *      path="/update/employees/{id}",
     *      operationId="update employees",
     *      tags={"Employee"},
     *      summary="update employees",
     *      description="update employees",
     *     @OA\Parameter(
     *          name="id",
     *          description="employeeID",
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
     *           property="position_id",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="company_id",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="birth",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="pay_rate_per_hour",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="education",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="profile_image",
     *           type="file",
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
    public function update(Request $request,Employee $emp)
    {
        $this->validateRequest($request,'sometimes|');
        $response = $this->EmployeeRepository->update( $emp  ,$request->all());
        return Utilities::wrap($response);
    }

    /**
     * @OA\Post(
     *      path="/update/employees/{id}/status",
     *      operationId="updateEmployee status",
     *      tags={"Employee"},
     *      summary="update employee status ",
     *      description="update employee status",
     *     @OA\Parameter(
     *          name="id",
     *          description="employeeID",
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
        $response = $this->EmployeeRepository->updateStatus($id ,array('status' => $request->status));
        return Utilities::wrap($response);
    }

    /**
     * @OA\Delete(
     *      path="delete/employees/{id}",
     *      operationId="deleteEmployee",
     *      tags={"Employee"},
     *      summary="delete employee ",
     *      description="delete employee",
     *     @OA\Parameter(
     *          name="id",
     *          description="employeeID",
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
        $response = $this->EmployeeRepository->updateStatus($id ,array('is_deleted' => 1));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'name' => $options."required|string|unique:users,name,{$this->user->id}",
            'email' => $options."required|email|unique:users,email,{$this->user->id}",
            'personal_phone' => $options.'required|integer|min:6',
            'business_phone' => $options.'required|integer|min:6',
            'address' => $options.'required|string',
            'date' => $options.'required|string',
            'status' => $options.'required|string',
            'note' => $options.'required|string',
            'position_id' => $options.'required|exists:positions,id',
            'company_id' => $options.'required|exists:companies,id',
            'birth' => $options.'required|string',
            'pay_rate_per_hour' => $options.'required|string',
            'profile_image' => $options.'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'education' => $options.'required|string',
        ]);
    }
}
