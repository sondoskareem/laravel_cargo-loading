<?php
namespace App\Repository;

use App\User;
use App\Customer;
use Illuminate\Support\Facades\DB;
// use App\Helper\Utilities;

use Illuminate\Support\Arr;

class CustomerRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Customer::where($conditions);

        if(!is_null($columns))
            $result = $result->select($columns);

        if(!is_null($sort))
            $result = $result->orderBy($sort->column, $sort->dir);

       $response = [
           'items' => $result->skip($skip)->take($take)->get(),
           'totalCount' => $result->count()
       ];

       return $response;
    }

    public function getById($id){
        $customer = Customer::findorFail($id);
        $user = $customer->user()->get();
        $finalCustomer = Arr::flatten(Arr::prepend(array($customer),array($user)));

        return $finalCustomer;
    }

    public function create($data){

        $user = User::create([
            'name' =>$data['name'],
            'email'=>$data['email'],
            'status'=>$data['status'],
            'personal_phone'=>$data['personal_phone'],
            'business_phone'=>$data['business_phone'],
            'address'=>$data['address'],
            'date'=>$data['date'],
            'password'=>bcrypt('password'),
            'type'=>'customer',
            'note'=>$data['note'],
        ]);
        if($user){
            $customer = $user->customers()->create([
                'mc_number' =>$data['mc_number'],
                'dot_number' =>$data['dot_number'],
                'website' =>$data['website'],
                'invoive_factoring_approvment' =>$data['invoive_factoring_approvment'],
                'invoice_mail' =>$data['invoice_mail'],
                'personal_fax' =>$data['personal_fax'],
                'business_fax' =>$data['business_fax'],
            ]);
        }

        return Arr::flatten(Arr::prepend(array($customer),array($user)));
    }

    public function update($customer, $values){
        $user = $customer->user()->get();

        $customer = tap($customer)->update($values);

        $user()->update($values);
        return array('msg'=>true);
    }

    public function updateStatus($id, $values){
        $customer = Customer::findorFail($id);
        $customer = $customer->user()->update($values);
        return array('msg'=>true);
    }


}
