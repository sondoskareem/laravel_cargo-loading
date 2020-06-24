<?php
namespace App\Repository;

use App\User;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Str;
class EmployeeRepository extends BaseRepository {
    use UploadTrait;

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

        if ($data->hasFile('profile_image')) {
            $image = $data->file('profile_image');
            $name = Str::slug($data->input('name')).'_'.time();
            $folder = '/uploads/images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);

            

        $user = User::create([
            'name' =>$data['name'],
            'email'=>$data['email'],
            'status'=>$data['status'],
            'personal_phone'=>$data['personal_phone'],
            'business_phone'=>$data['business_phone'],
            'address'=>$data['address'],
            'date'=>$data['date'],
            'type'=>'employee',
            'note'=>$data['note'],
        ]);
            $employee = $user->employees()->create([
                'position_id' =>$data['position_id'],
                'company_id' =>$data['company_id'],
                'birth' =>$data['birth'],
                'pay_rate_per_hour' =>$data['pay_rate_per_hour'],
                'education' =>$data['education'],
                'profile_image' =>$filePath,
            ]);

            return Arr::flatten(Arr::prepend(array($employee),array($user)));
        }else return Null;
    }

    public function update($employee, $values){
        $user = $employee->user()->get();

        $values['name'] ?: $values['name'] = $user->first()->name;
        $values['email'] ?: $values['email'] = $user->first()->email;
        $values['status'] ?: $values['status'] = $user->first()->status;
        $values['personal_phone'] ?: $values['personal_phone'] = $user->first()->personal_phone;
        $values['business_phone'] ?: $values['business_phone'] = $user->first()->business_phone;
        $values['address'] ?: $values['address'] = $user->first()->address;
        $values['date'] ?: $values['date'] = $user->first()->date;
        $values['note'] ?: $values['note'] = $user->first()->note;

        $values['position_id'] ?: $values['position_id'] = $employee->position_id;
        $values['company_id'] ?: $values['company_id'] = $employee->company_id;
        $values['birth'] ?: $values['birth'] = $employee->birth;
        $values['pay_rate_per_hour'] ?: $values['pay_rate_per_hour'] = $employee->pay_rate_per_hour;
        $values['education'] ?: $values['education'] = $employee->education;

        $employee = tap($employee)->update([
            'position_id' => $values['position_id'],
            'company_id' => $values['company_id'] ,
            'birth' => $values['birth'] ,
            'pay_rate_per_hour' => $values['pay_rate_per_hour'],
            'education' => $values['education'] 
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
        return true;
    }
    
    
}
