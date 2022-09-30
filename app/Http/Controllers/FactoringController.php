<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\FactoringRepository;
use App\Factoring;
use App\Helper\Utilities;
class FactoringController extends Controller
{

    private $FactoringRepository;
    public function __construct()
    {
        $this->FactoringRepository = new FactoringRepository(new Factoring());
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
            $response = $this->FactoringRepository->getList($conditions, $columns, $sort, $skip, $take);

            // Response
            return Utilities::wrap($response);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->FactoringRepository->create($request);
        return Utilities::wrap($response);
    }



    public function update(Request $request,Factoring $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->FactoringRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }


    public function destroy(Factoring $id)
    {
        $response = $this->FactoringRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = '' ){

        return $this->validate($request,[
            'company_id' => $options.'required|exists:companies,id',
            'name' => $options.'required|string',
            'address' => $options.'required|string',
            'phone' => $options.'required|integer|min:6',
            'fax' => $options.'required|string',
            'contract_exp' => $options.'required|string',
            'advanced_rate' => $options.'required|integer',
            'reserve_ammount' => $options.'required|integer',
            'escrow_fee' => $options.'required|integer',
            'monthly_minimum' => $options.'required|integer',
        ]);
    }
}

