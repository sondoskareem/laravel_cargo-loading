<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\CompanyRepository;
use App\Helper\Utilities;
use App\Company;
class CompanyController extends Controller
{
    private $CompanyRepository;
    public function __construct()
    {
        $this->CompanyRepository = new CompanyRepository(new Company());
        $this->middleware('auth:api');
        $this->user = auth('api')->user();
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $response = $this->CompanyRepository->create($request->all());
        return Utilities::wrap($response);
    }


    public function show()
    {
        $response = $this->CompanyRepository->getCompany();
        return Utilities::wrap($response);
    }


    public function update(Request $request,Company $id) {
        $this->validateRequest($request,'sometimes|');
        $response = $this->CompanyRepository->update($id,$request->all());
        return Utilities::wrap($response);
    }



    private function validateRequest( $request, $options = ''  ){

        return $this->validate($request,[
            'name' => $options.'required|string',
            'email' => $options.'required|email|max:255|unique:users',
            'phone' => $options.'required|integer|min:6',
            'first_address' => $options.'required|string',
            'second_address' => $options.'required|string',
            'fax' => $options.'required|integer',

        ]);
    }
}
