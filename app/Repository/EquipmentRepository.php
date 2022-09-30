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
            $equipment = Equipment::create($data);
        return $equipment;
    }

    public function update($equipment, $values){

        $equipment = tap($equipment)->update($values);
        return $equipment;
    }

    public function destroy($equipment ,$values){
       $equipment['is_deleted'] =$values['is_deleted'];
        $equipment->save();
        return array('Equipment'=>$equipment);
    }
}
