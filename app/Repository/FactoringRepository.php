<?php
namespace App\Repository;

use App\Factoring;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Commodity;
use Str;
class FactoringRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Factoring::where('is_deleted', '=', 0)->where($conditions);

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
            $factoring = Factoring::create($data);
        return $factoring;
    }

    public function update($factoring, $values){

        $factoring = tap($factoring)->update($values);
        return $factoring;
    }

    public function destroy($factoring ,$values){
       $factoring['is_deleted'] =$values['is_deleted'];
        $factoring->save();
        return array('Cmmodity'=>$factoring);
    }
}
