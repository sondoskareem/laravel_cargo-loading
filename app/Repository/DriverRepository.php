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
                'type'=>'driver',
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
        return Arr::flatten(Arr::prepend(array($driver),array($user)));

            }
        }else return Null;


       
    }

    public function update($driver, $values){
        $user = $driver->user()->get();

        $values['name'] ?: $values['name'] = $user->first()->name;
        $values['email'] ?: $values['email'] = $user->first()->email;
        $values['status'] ?: $values['status'] = $user->first()->status;
        $values['personal_phone'] ?: $values['personal_phone'] = $user->first()->personal_phone;
        $values['business_phone'] ?: $values['business_phone'] = $user->first()->business_phone;
        $values['address'] ?: $values['address'] = $user->first()->address;
        $values['date'] ?: $values['date'] = $user->first()->date;
        $values['note'] ?: $values['note'] = $user->first()->note;

        $values['position_id'] ?: $values['position_id'] = $driver->position_id;
        $values['company_id'] ?: $values['company_id'] = $driver->company_id;
        $values['birth'] ?: $values['birth'] = $driver->birth;
        $values['home_terminal'] ?: $values['home_terminal'] = $driver->home_terminal;
        $values['state'] ?: $values['state'] = $driver->state;
        $values['endorsements'] ?: $values['endorsements'] = $driver->endorsements;
        $values['hazmat'] ?: $values['hazmat'] = $driver->hazmat;
        $values['tanker'] ?: $values['tanker'] = $driver->tanker;
        $values['double_triple'] ?: $values['double_triple'] = $driver->double_triple;
        $values['dl_exp'] ?: $values['dl_exp'] = $driver->dl_exp;
        $values['medical_exp'] ?: $values['medical_exp'] = $driver->medical_exp;
        $values['pay_rate'] ?: $values['pay_rate'] = $driver->pay_rate;

        $driver = tap($driver)->update([
            'position_id' => $values['position_id'],
            'company_id' => $values['company_id'] ,
            'birth' => $values['birth'] ,
            'home_terminal' => $values['home_terminal'],
            'state' => $values['state'] ,
            'endorsements' => $values['endorsements'] ,
            'hazmat' => $values['hazmat'] ,
            'tanker' => $values['tanker'] ,
            'dl_exp' => $values['dl_exp'] ,
            'double_triple' => $values['double_triple'] ,
            'medical_exp' => $values['medical_exp'] ,
            'pay_rate' => $values['pay_rate'] ,
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
            'type' => 'driver' ,
        ]);
        return array('msg'=>true);
    }
    
    public function updateStatus($id, $values){
        $driver = Driver::findorFail($id);
        $driver = tap($driver->user())->update($values);
        return array('msg'=>true);
    }
    
}
