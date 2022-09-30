<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CommodityRepository;
use App\Commodity;
use App\Helper\Utilities;
class CommodityController extends Controller
{

    private $CommodityRepository;
    public function __construct()
    {
        $this->CommodityRepository = new CommodityRepository(new Commodity());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }


    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->CommodityRepository->create($request);
        return Utilities::wrap($response);
    //  return 'dd';
    }



    public function update(Request $request,Commodity $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->CommodityRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }



    public function destroy(Commodity $id)
    {
        $response = $this->CommodityRepository->destroy($id ,array('is_deleted' => true));
        return Utilities::wrap($response);
    }

    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'stop_id' => $options.'required|exists:stops,id',
            'description' => $options.'required|string',
            'Packaging' => $options.'required|string',
            'quantity' => $options.'required|integer',
            'weight' => $options.'required|integer',
        ]);
    }
}

