<?php
namespace App\Repository;

use App\Factoring;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Equipment;
use Str;
class EquipmentRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Equipment::where('is_deleted', '=', 0)->where($conditions);

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

    public function create($data){
            $equipment = Equipment::create([
                'company_id' =>$data['company_id'],
                'car_type' =>$data['car_type'],
                'plate' =>$data['plate'],
                'state' =>$data['state'],
                'make' =>$data['make'],
                'model' =>$data['model'],
                'color' =>$data['color'],
                'year' =>$data['year'],
                'service_type' =>$data['service_type'],
                'vin_number' =>$data['vin_number'],
            ]);
        return $equipment;
    }

    public function update($equipment, $values){
        $values['company_id'] ?: $values['company_id'] = $equipment->company_id;
        $values['car_type'] ?: $values['car_type'] = $equipment->car_type;
        $values['plate'] ?: $values['plate'] = $equipment->plate;
        $values['state'] ?: $values['state'] = $equipment->state;
        $values['make'] ?: $values['make'] = $equipment->make;
        $values['model'] ?: $values['model'] = $equipment->model;
        $values['color'] ?: $values['color'] = $equipment->color;
        $values['year'] ?: $values['year'] = $equipment->year;
        $values['service_type'] ?: $values['service_type'] = $equipment->service_type;
        $values['vin_number'] ?: $values['vin_number'] = $equipment->vin_number;

        $equipment = tap($equipment)->update([
            'company_id' => $values['company_id'],
            'car_type' => $values['car_type'],
            'plate' => $values['plate'],
            'state' => $values['state'],
            'make' => $values['make'],
            'model' => $values['model'],
            'color' => $values['color'],
            'year' => $values['year'],
            'service_type' => $values['service_type'],
            'vin_number' => $values['vin_number'],
            
        ]);
        return $equipment;
    }
    
    public function destroy($equipment ,$values){
       $equipment['is_deleted'] =$values['is_deleted'];
        $equipment->save();
        return array('Cmmodity'=>$equipment);
    }
}
