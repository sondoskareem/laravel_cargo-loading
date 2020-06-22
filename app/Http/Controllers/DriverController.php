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
        // $this->user = auth()->user();
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
            $response = $this->DriverRepository->getList($conditions, $columns, $sort, $skip, $take);
    
            // Response
            return Utilities::wrap($response);
    }

    
    

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->DriverRepository->create($request);
        return Utilities::wrap($response);
    }

    
    public function show($id)
    {
        $response = $this->DriverRepository->getById($id);
        return Utilities::wrap($response);
    }

   

    
    public function update(Request $request, $id)
    {
    }

    
    public function destroy($id)
    {
    }

    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'name' => $options.'required',
            'email' => 'required|email',
            'personal_phone' => $options.'required|integer',
            'business_phone' => $options.'required|integer',
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
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'medical_exp' => $options.'required|string',
            'pay_rate' => $options.'required|integer',
        ]);
    }
}