<?php
namespace App\Repository;

use App\Load;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Stop;
use Str;
class StopRepository extends BaseRepository {
    use UploadTrait;


    public function create($data){
            $Stop = Stop::create($data);
        return $Stop;
    }

    public function update($stops, $values){
        // $load = Breaks::findorFail($stops);
        $stops = tap($stops)->update($values);
        return $stops;
    }

    public function destroy($stops ,$values){
       $stops['is_deleted'] =$values['is_deleted'];
        $stops->save();
        return array('Stops'=>$stops);
    }
}
