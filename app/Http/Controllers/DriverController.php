<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Repository\DriverRepository;
use App\Helper\Utilities;

class DriverController extends Controller
{
    private $DriverRepository;
    public function __construct()
    {
        $this->DriverRepository = new DriverRepository(new Driver());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }

    /**
     * @OA\Post(
     *      path="/all/drivers",
     *      operationId="get all drivers",
     *      tags={"Driver"},
     *      summary="get all drivers",
     *      description="get all drivers",
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
     *          example={{"endorsements","=","any"} , {"user_id","=","2"}},
     *
     *          ),
     *         @OA\Property(
     *           property="columns",
     *           type="array",
     *        @OA\Items(
     *          type="array",
     *          @OA\Items()
     *         ),
     *          example={"id", "endorsements", "dl_exp"},
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
            $response = $this->DriverRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }


     /**
     * @OA\Post(
     *      path="/drivers",
     *      operationId="create drivers",
     *      tags={"Driver"},
     *      summary="create drivers",
     *      description="create drivers",
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
     *           property="home_terminal",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="dl_hash",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="state",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="endorsements",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="hazmat",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="tanker",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="double_triple",
     *           type="integer",
     *          ),
     *       @OA\Property(
     *           property="dl_exp",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="profile_image",
     *           type="file",
     *          ),
     *      @OA\Property(
     *           property="medical_exp",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="pay_rate",
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
        $response = $this->DriverRepository->create($request);
        return Utilities::wrap($response);
    }

    /**
     * @OA\Post(
     *      path="/drivers/{id}",
     *      operationId="get drivers ByID",
     *      tags={"Driver"},
     *      summary="Get drivers By ID",
     *      description="Returns drivers full info",
     *     @OA\Parameter(
     *          name="id",
     *          description="driverID",
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
        $response = $this->DriverRepository->getById($id);
        return Utilities::wrap($response);
    }


    /**
     * @OA\Post(
     *      path="/update/drivers/{id}",
     *      operationId="update drivers",
     *      tags={"Driver"},
     *      summary="update drivers",
     *      description="update drivers",
     *     @OA\Parameter(
     *          name="id",
     *          description="driver ID",
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
     *           property="home_terminal",
     *           type="string",
     *          ),
     *       @OA\Property(
     *           property="dl_hash",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="state",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="endorsements",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="hazmat",
     *           type="boolean",
     *          ),
     *       @OA\Property(
     *           property="tanker",
     *           type="boolean",
     *          ),
     *       @OA\Property(
     *           property="double_triple",
     *           type="boolean",
     *          ),
     *       @OA\Property(
     *           property="dl_exp",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="profile_image",
     *           type="file",
     *          ),
     *      @OA\Property(
     *           property="medical_exp",
     *           type="string",
     *          ),
     *      @OA\Property(
     *           property="pay_rate",
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
    public function update(Request $request,Driver $id)
    {
        $this->validateRequest($request,'sometimes|');
        $response = $this->DriverRepository->update( $id  ,$request->all());
        return Utilities::wrap($response);
    }


    /**
     * @OA\Post(
     *      path="/update/drivers/{id}/status",
     *      operationId="update drivers status",
     *      tags={"Driver"},
     *      summary="update drivers status ",
     *      description="update drivers status",
     *     @OA\Parameter(
     *          name="id",
     *          description="driversID",
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
        $response = $this->DriverRepository->updateStatus($id ,array('status' => $request->status));
        return Utilities::wrap($response);
    }


     /**
     * @OA\Delete(
     *      path="/delete/drivers/{id}",
     *      operationId="delete driver",
     *      tags={"Driver"},
     *      summary="delete drivers ",
     *      description="delete drivers",
     *     @OA\Parameter(
     *          name="id",
     *          description="driver ID",
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
        $response = $this->DriverRepository->updateStatus($id ,array('is_deleted' => 1));
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
            'home_terminal' => $options.'required|string',
            'dl_hash' => $options.'required|string',
            'state' => $options.'required|string',
            'endorsements' => $options.'required|string',
            'hazmat' => $options.'required|boolean',
            'tanker' => $options.'required|boolean',
            'double_triple' => $options.'required|boolean',
            'dl_exp' => $options.'required|string',
            'profile_image' => $options.'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'medical_exp' => $options.'required|string',
            'pay_rate' => $options.'required|integer',
        ]);
    }
}
