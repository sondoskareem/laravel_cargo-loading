<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Utilities;
use App\Repository\CustomerRepository;

class CustomerController extends Controller
{
    private $CustomerRepository;
    public function __construct()
    {
        $this->CustomerRepository = new CustomerRepository(new User());
        // $this->user = auth()->user();
    }
    
    public function index()
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
            $response = $this->UserRepository->getList($conditions, $columns, $sort, $skip, $take);
    
            // Response
            return Utilities::wrap($response);
    }

    
    

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->UserRepository->create($request->all());
        return Utilities::wrap( $response);
    }

    
    public function show($id)
    {
        $response = $this->UserRepository->getById($id);
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
            'email' => 'integer|email',
            'personal_phone' => $options.'required|Digits',
            'business_phone' => $options.'required|Digits',
            // 'password' => $options.'required|string',
            // 'type' => $options.'required|json',
            'address' => $options.'required|string',
            'date' => $options.'required|string',
            // 'status' => $options.'required|json',
            'note' => $options.'required|string',
            'mc_number' => $options.'required|string',
            'dot_number' => $options.'required|string',
            'website' => $options.'required|string',
            'invoive_factoring_approvment' => $options.'required|string',
            'invoice_mail' => $options.'required|string',
            'personal_fax' => $options.'required|integer',
            'business_fax' => $options.'required|integer',
        ]);
    }
}
