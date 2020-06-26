<?php
namespace App\Repository;

use App\Customer;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Breaks;
use Str;
class StopRepository extends BaseRepository {
    use UploadTrait;

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Breaks::where('is_deleted', '=', 0)->where($conditions);

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
        $Breaks = Breaks::findorFail($id);
        $customer = $Breaks->customer()->get();
        $finalLoad = Arr::flatten(Arr::prepend(array($Breaks),array($customer)));

        return $finalLoad;
    }

    public function create($data){
            $Stop = Breaks::create([
                'load_id' =>$data['load_id'],
                'load_type' =>$data['load_type'],
                'stop_description' =>$data['stop_description'],
                'trailer_type' =>$data['trailer_type'],
                'facility' =>$data['facility'],
                'address' =>$data['address'],
                'phone' =>$data['phone'],
                'appointment_type' =>$data['appointment_type'],
                'driver_work' =>$data['driver_work'],
                'facility_note' =>$data['facility_note'],
            ]);
        return $Stop;
    }

    public function update($stops, $values){
        // $load = Breaks::findorFail($stops);
        $values['load_id'] ?: $values['load_id'] = $stops->load_id;
        $values['load_type'] ?: $values['load_type'] = $stops->load_type;
        $values['stop_description'] ?: $values['stop_description'] = $stops->stop_description;
        $values['trailer_type'] ?: $values['trailer_type'] = $stops->trailer_type;
        $values['facility'] ?: $values['facility'] = $stops->facility;
        $values['address'] ?: $values['address'] = $stops->address;
        $values['phone'] ?: $values['phone'] = $stops->phone;
        $values['appointment_type'] ?: $values['appointment_type'] = $stops->appointment_type;
        $values['driver_work'] ?: $values['driver_work'] = $stops->driver_work;
        $values['facility_note'] ?: $values['facility_note'] = $stops->facility_note;
  

        $stops = tap($stops)->update([
            'load_id' => $values['load_id'],
            'load_type' => $values['load_type'],
            'stop_description' => $values['stop_description'],
            'trailer_type' => $values['trailer_type'],
            'facility' => $values['facility'],
            'address' => $values['address'],
            'phone' => $values['phone'],
            'appointment_type' => $values['appointment_type'],
            'driver_work' => $values['driver_work'],
            'driver_work' => $values['driver_work'],
            'facility_note' => $values['facility_note'],
            
        ]);
        return $stops;
    }
    
    
    
    public function destroy($stops ,$values){
       $stops['is_deleted'] =$values['is_deleted'];
        $stops->save();
        return array('Stops'=>$stops);
    }
}
