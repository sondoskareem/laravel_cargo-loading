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
            $commodity = Commodity::create([
                'stop_id' =>$data['stop_id'],
                'description' =>$data['description'],
                'Packaging' =>$data['Packaging'],
                'quantity' =>$data['quantity'],
                'weight' =>$data['weight'],
            ]);
        return $commodity;
    }

    public function update($commodity, $values){
        $values['stop_id'] ?: $values['stop_id'] = $commodity->stop_id;
        $values['description'] ?: $values['description'] = $commodity->description;
        $values['Packaging'] ?: $values['Packaging'] = $commodity->Packaging;
        $values['quantity'] ?: $values['quantity'] = $commodity->quantity;
        $values['weight'] ?: $values['weight'] = $commodity->weight;

        $commodity = tap($commodity)->update([
            'stop_id' => $values['stop_id'],
            'description' => $values['description'],
            'Packaging' => $values['Packaging'],
            'quantity' => $values['quantity'],
            'weight' => $values['weight'],
            
        ]);
        return $commodity;
    }
    
    public function destroy($commodity ,$values){
       $commodity['is_deleted'] =$values['is_deleted'];
        $commodity->save();
        return array('Cmmodity'=>$commodity);
    }
}
