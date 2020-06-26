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

    
    

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->LoadRepository->create($request);
        return Utilities::wrap($response);
       
    }

    
    public function show($id)
    {
        $response = $this->LoadRepository->getById($id);
        return Utilities::wrap($response);
    }

   

    
    public function update(Request $request,Load $id) { 
        $this->validateRequest($request,'sometimes|');
        $response = $this->LoadRepository->update($id,$request);
        return Utilities::wrap($response);
    }

    
    public function updateStatus(Request $request , Load $id)
    {
        request()->validate(['status' => 'required|string']);
        $response = $this->LoadRepository->updateStatus($id ,array('status' => $request->status));
        return Utilities::wrap($response);
    }

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

