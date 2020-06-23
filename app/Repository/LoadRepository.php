<?php
namespace App\Repository;

use App\Customer;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Load;
use Str;
class LoadRepository extends BaseRepository {
    use UploadTrait;

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Load::where('is_deleted', '=', 0)->where($conditions);

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
        $Load = Load::findorFail($id);
        $customer = $Load->customer()->get();
        $finalLoad = Arr::flatten(Arr::prepend(array($Load),array($customer)));

        return $finalLoad;
    }

    public function create($data){

            $Load = Load::create([
                'customer_id' =>$data['customer_id'],
                'employee_id' =>$data['employee_id'],
                'po_load' =>$data['po_load'],
                'load_rate' =>$data['load_rate'],
                'loaded_mile' =>$data['loaded_mile'],
                'load_type' =>$data['load_type'],
                'trailer_type' =>$data['trailer_type'],
                'endorsements' =>$data['endorsements'],
                'number_of_stop' =>$data['number_of_stop'],
                'trailer_model' =>$data['trailer_model'],
                'status' =>$data['status'],
            ]);
        return $Load;
    }

    public function update($id, $values){
        $load = Load::findorFail($id);
        $load = tap($load)->update($values);
        return $load;
    }
    
    
}
