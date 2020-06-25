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
        $result = Customer::where('is_deleted', '=', 0)->where($conditions);

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

        $values['name'] ?: $values['name'] = $user->first()->name;
        $values['email'] ?: $values['email'] = $user->first()->email;
        $values['status'] ?: $values['status'] = $user->first()->status;
        $values['personal_phone'] ?: $values['personal_phone'] = $user->first()->personal_phone;
        $values['business_phone'] ?: $values['business_phone'] = $user->first()->business_phone;
        $values['address'] ?: $values['address'] = $user->first()->address;
        $values['date'] ?: $values['date'] = $user->first()->date;
        $values['note'] ?: $values['note'] = $user->first()->note;

        $values['mc_number'] ?: $values['mc_number'] = $customer->mc_number;
        $values['dot_number'] ?: $values['dot_number'] = $customer->dot_number;
        $values['website'] ?: $values['website'] = $customer->website;
        $values['invoive_factoring_approvment'] ?: $values['invoive_factoring_approvment'] = $customer->invoive_factoring_approvment;
        $values['invoice_mail'] ?: $values['invoice_mail'] = $customer->invoice_mail;
        $values['personal_fax'] ?: $values['personal_fax'] = $customer->personal_fax;
        $values['business_fax'] ?: $values['business_fax'] = $customer->business_fax;

        $customer = tap($customer)->update([
            'mc_number' => $values['mc_number'],
            'dot_number' => $values['dot_number'] ,
            'website' => $values['website'] ,
            'invoive_factoring_approvment' => $values['invoive_factoring_approvment'],
            'invoice_mail' => $values['invoice_mail'] ,
            'personal_fax' => $values['personal_fax'] ,
            'business_fax' => $values['business_fax'] ,
        ]);

        $user = tap($user->first())->update([
            'name' => $values['name'],
            'email' => $values['email'] ,
            'status' => $values['status'] ,
            'personal_phone' => $values['personal_phone'],
            'business_phone' => $values['business_phone'] ,
            'address' => $values['address'] ,
            'date' => $values['date'] ,
            'note' => $values['note'] ,
        ]);
        return array('msg'=>true);
    }

    public function updateStatus($id, $values){
        $customer = Customer::findorFail($id);
        $customer = tap($customer->user())->update($values);
        return array('msg'=>true);
    }
    
    
}
