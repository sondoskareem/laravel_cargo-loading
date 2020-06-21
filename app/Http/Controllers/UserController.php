<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repository\UserRepository;
// use App\Middleware\Authenticate;

class UserController extends Controller
{

    protected $user;
    private $UserRepository;
    public function __construct()
    {
        $this->UserRepository = new UserRepository(new User());
        $this->user = auth()->user();
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
            'status' => $options.'required|integer',
            'driver_id' => 'integer|nullable',
            'items' => $options.'required|json',
            'details' => $options.'required|json',
            'provider' => $options.'required|json',
            'customer' => $options.'required|json',
        ]);
    }
}
