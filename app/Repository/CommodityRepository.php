<?php
namespace App\Repository;

use App\Load;
use Illuminate\Support\Facades\DB;
use App\Helper\Utilities;
use Validator,Redirect,Response,File;
use Illuminate\Support\Arr;
use App\Traits\UploadTrait;
use App\Commodity;
use Str;
class CommodityRepository extends BaseRepository {


    public function create($data){
            $commodity = Commodity::create($values);
        return $commodity;
    }

    public function update($commodity, $values){

        $commodity = tap($commodity)->update($values);
        return $commodity;
    }

    public function destroy($commodity ,$values){
       $commodity['is_deleted'] =$values['is_deleted'];
        $commodity->save();
        return array('Cmmodity'=>$commodity);
    }
}
