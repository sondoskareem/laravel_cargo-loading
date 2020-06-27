<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\EquipmentRepository;
use App\Equipment;
use App\Helper\Utilities;

class EquipmentController extends Controller
{

    private $EquipmentRepository;
    public function __construct()
    {
        $this->EquipmentRepository = new EquipmentRepository(new Equipment());
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
            $response = $this->EquipmentRepository->getList($conditions, $columns, $sort, $skip, $take);
    
            // Response
            return Utilities::wrap($response);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->EquipmentRepository->create($request);
        return Utilities::wrap($response);
    }


    
    public function update(Request $request,Equipment $id) { 
        $this->validateRequest($request,'sometimes|');
        $response = $this->EquipmentRepository->update($id,$request);
        return Utilities::wrap($response);
    }
    
    
    public function destroy(Equipment $id)
    {
        $response = $this->EquipmentRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = '' ){

        return $this->validate($request,[
            'company_id' => $options.'required|exists:companies,id',
            'car_type' => $options.'required|string',
            'plate' => $options.'required|string',
            'state' => $options.'required|string',
            'make' => $options.'required|string',
            'model' => $options.'required|string',
            'color' => $options.'required|string',
            'year' => $options.'required|string',
            'service_type' => $options.'required|string',
            'vin_number' => $options.'required|integer',
        ]);
    }
}