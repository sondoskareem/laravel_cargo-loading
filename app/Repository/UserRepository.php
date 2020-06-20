<?php
namespace App\Core\DAL;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository {

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
        if (User::create($data))
            return true;
        else {
            return null;
        }
    }

    public function update($id, $values){
        $user = User::findorFail($id);
        $user = tap($user)->update($values);
        return $user;
    }
    
    
}
