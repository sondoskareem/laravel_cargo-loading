<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repository\RepresentativeRepository;
use App\Representative;
use App\Helper\Utilities;
class RepresentativeController extends Controller
{

    private $RepresentativeRepository;
    public function __construct()
    {
        $this->RepresentativeRepository = new RepresentativeRepository(new Representative());
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
            $response = $this->RepresentativeRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->RepresentativeRepository->create($request);
        return Utilities::wrap($response);
    }



    public function update(Request $request,Representative $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->RepresentativeRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }


    public function destroy(Representative $id)
    {
        $response = $this->RepresentativeRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = '' ){

        return $this->validate($request,[
            'factoring_id' => $options.'required|exists:factorings,id',
            'representative' => $options.'required|string',
            'rep_phone' => $options.'required|integer|min:6',
            'rep_email' => $options.'required|email|string',
            'payment_email' => $options.'required|email|string',
        ]);
    }
}
