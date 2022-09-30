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
            $Load = Load::create($data);
        return $Load;
    }

    public function update($load, $values){
        $load = tap($load)->update($values);

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
