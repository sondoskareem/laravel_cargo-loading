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

            $Load = Company::create([
                'name' =>$data['name'],
                'email' =>$data['email'],
                'phone' =>$data['phone'],
                'first_address' =>$data['first_address'],
                'second_address' =>$data['second_address'],
                'fax' =>$data['fax'],
            ]);
        return $Load;
    }

    public function update($id, $values){
        $values['name'] ?: $values['name'] = $id->name;
        $values['phone'] ?: $values['phone'] = $id->phone;
        $values['email'] ?: $values['email'] = $id->email;
        $values['first_address'] ?: $values['first_address'] = $id->first_address;
        $values['second_address'] ?: $values['second_address'] = $id->second_address;
        $values['fax'] ?: $values['fax'] = $id->fax;

        $company = tap($id)->update([
            'name' => $values['name'],
            'phone' => $values['phone'],
            'email' => $values['email'],
            'first_address' => $values['first_address'],
            'second_address' => $values['second_address'],
            'fax' => $values['fax'],
        ]);
        return $company;
    }
    
    
}
