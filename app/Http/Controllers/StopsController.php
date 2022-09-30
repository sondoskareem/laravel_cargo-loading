<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\StopRepository;
use App\Stop;
use App\Helper\Utilities;
class StopsController extends Controller
{

    private $StopRepository;
    public function __construct()
    {
        $this->StopRepository = new StopRepository(new Stop());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }

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
            $response = $this->StopRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }




    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->StopRepository->create($request);
        return Utilities::wrap($response);
    //  return 'dd';
    }


    public function show($id)
    {
        $response = $this->StopRepository->getById($id);
        return Utilities::wrap($response);
    }




    public function update(Request $request,Stop $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->StopRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }



    public function destroy(Stop $id)
    {
        $response = $this->StopRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'load_id' => $options.'required|exists:loads,id',
            'load_type' => $options.'required|string',
            'stop_description' => $options.'required|string',
            'trailer_type' => $options.'required|string',
            'facility' => $options.'required|string',
            'address' => $options.'required|string',
            'phone' => $options.'required|integer|min:6',
            'appointment_type' => $options.'required|string',
            'driver_work' => $options.'required|string',
            'facility_note' => $options.'required|string',
        ]);
    }
}
