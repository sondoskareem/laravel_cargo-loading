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
        $stops = $Load->stops()->get();
        $finalLoad = (['Load'=>$Load,'Customer'=>$customer, 'Stops' =>$stops]);

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

    public function update($load, $values){
        // $load = Load::findorFail($load);
        $values['customer_id'] ?: $values['customer_id'] = $load->customer_id;
        $values['employee_id'] ?: $values['employee_id'] = $load->employee_id;
        $values['po_load'] ?: $values['po_load'] = $load->po_load;
        $values['load_rate'] ?: $values['load_rate'] = $load->load_rate;
        $values['load_type'] ?: $values['load_type'] = $load->load_type;
        $values['loaded_mile'] ?: $values['loaded_mile'] = $load->loaded_mile;
        $values['trailer_type'] ?: $values['trailer_type'] = $load->trailer_type;
        $values['status'] ?: $values['status'] = $load->status;
        $values['endorsements'] ?: $values['endorsements'] = $load->endorsements;
        $values['number_of_stop'] ?: $values['number_of_stop'] = $load->number_of_stop;
        $values['trailer_model'] ?: $values['trailer_model'] = $load->trailer_model;
  

        $load = tap($load)->update([
            'customer_id' => $values['customer_id'],
            'employee_id' => $values['employee_id'],
            'po_load' => $values['po_load'],
            'load_rate' => $values['load_rate'],
            'load_type' => $values['load_type'],
            'loaded_mile' => $values['loaded_mile'],
            'trailer_type' => $values['trailer_type'],
            'status' => $values['status'],
            'endorsements' => $values['endorsements'],
            'number_of_stop' => $values['number_of_stop'],
            'trailer_model' => $values['trailer_model'],
            
        ]);
     
        return $load;
    }
    
    public function updateStatus($load , $values){
        $load = tap($load)->get()->update($values);
        return array('Load'=>$load);
    }
    
    public function destroy($load ,$values){
       $load['is_deleted'] =$values['is_deleted'];
        $load->save();
        return array('Load'=>$load);
    }
}
