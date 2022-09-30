<?php
namespace App\Repository;

use App\Company;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use Str;
class CompanyRepository extends BaseRepository {


    public function getCompany(){
        $company = Employee::where('user_id' ,auth('api')->user()->id)->get();
        $company = $company->first()->company()->get();
        return $company->first() ;
    }

    public function create($data){

            $Load = Company::create($data);
        return $Load;
    }

    public function update($company, $values){

        $company = $company->update($values);
        return $company;
    }


}
