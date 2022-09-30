<?php
namespace App\Repository;

use App\Factoring;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Representative;
use Str;
class RepresentativeRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = Representative::where('is_deleted', '=', 0)->where($conditions);

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
            $representative = Representative::create($data);
        return $representative;
    }

    public function update($representative, $values){
        $representative = tap($representative)->update($values);
        return $representative;
    }

    public function destroy($representative ,$values){
       $representative['is_deleted'] =$values['is_deleted'];
        $representative->save();
        return array('Cmmodity'=>$representative);
    }
}
