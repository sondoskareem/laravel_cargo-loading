<?php
namespace App\Repository;

use App\User;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;

use Illuminate\Support\Arr;

class EmployeeRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Employee::where('is_deleted', '=', 0)->where($conditions);

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
        $employee = Employee::findorFail($id);
        $user = $employee->user()->get();
        $finalEmployee = Arr::flatten(Arr::prepend(array($employee),array($user)));

        return $finalEmployee;
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
            $employee = $user->employees()->create([
                'position_id' =>$data['position_id'],
                'company_id' =>$data['company_id'],
                'birth' =>$data['birth'],
                'pay_rate_per_hour' =>$data['pay_rate_per_hour'],
                'education' =>$data['education'],
            ]);
        }
       
        return Arr::flatten(Arr::prepend(array($employee),array($user)));
    }

    public function update($id, $values){
        $user = User::findorFail($id);
        $user = tap($user)->update($values);
        return $user;
    }
    
    
}
