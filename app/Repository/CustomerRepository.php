<?php
namespace App\Repository;

use App\User;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends BaseRepository {

    public function getList($conditions, $columns, $sort, $skip, $take)
    {
        $result = User::where('is_deleted', '=', 0)->where($conditions);

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
        return User::findorFail($id);
    }

    public function create($data){

        return $data;
    }

    public function update($id, $values){
        $user = User::findorFail($id);
        $user = tap($user)->update($values);
        return $user;
    }
    
    
}
