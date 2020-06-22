<?php
namespace App\Repository;

use App\User;
use App\Employee;
use App\Driver;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Str;
use App\Traits\UploadTrait;

use Illuminate\Support\Arr;

class DriverRepository extends BaseRepository {
    use UploadTrait;

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Driver::where('is_deleted', '=', 0)->where($conditions);

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
        $driver = Driver::findorFail($id);
        $user = $driver->user()->get();
        $finalDriver = Arr::flatten(Arr::prepend(array($driver),array($user)));

        return $finalDriver;
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
                'password'=>bcrypt('password'),
                'type'=>'customer',
                'note'=>$data['note'],
            ]);
            if($user){
                $driver = $user->drivers()->create([
                    'position_id' =>$data['position_id'],
                    'company_id' =>$data['company_id'],
                    'birth' =>$data['birth'],
                    'pay_rate_per_hour' =>$data['pay_rate_per_hour'],
                    'home_terminal' =>$data['home_terminal'],
                    'dl_hash' =>$data['dl_hash'],
                    'state' =>$data['state'],
                    'endorsements' =>$data['endorsements'],
                    'hazmat' =>$data['hazmat'],
                    'tanker' =>$data['tanker'],
                    'double_triple' =>$data['double_triple'],
                    'dl_exp' =>$data['dl_exp'],
                    'medical_exp' =>$data['medical_exp'],
                    'pay_rate' =>$data['pay_rate'],
                    'profile_image' =>$filePath,
                    ]);
            }

        }

       
       //fileUpload
        return Arr::flatten(Arr::prepend(array($driver),array($user)));
    }

    public function update($id, $values){
        $user = User::findorFail($id);
        $user = tap($user)->update($values);
        return $user;
    }
    
    
}
