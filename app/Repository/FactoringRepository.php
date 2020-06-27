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
            $factoring = Factoring::create([
                'company_id' =>$data['company_id'],
                'name' =>$data['name'],
                'address' =>$data['address'],
                'phone' =>$data['phone'],
                'contract_exp' =>$data['contract_exp'],
                'fax' =>$data['fax'],
                'advanced_rate' =>$data['advanced_rate'],
                'reserve_ammount' =>$data['reserve_ammount'],
                'escrow_fee' =>$data['escrow_fee'],
                'monthly_minimum' =>$data['monthly_minimum'],
            ]);
        return $factoring;
    }

    public function update($factoring, $values){
        $values['company_id'] ?: $values['company_id'] = $factoring->company_id;
        $values['name'] ?: $values['name'] = $factoring->name;
        $values['address'] ?: $values['address'] = $factoring->address;
        $values['phone'] ?: $values['phone'] = $factoring->phone;
        $values['contract_exp'] ?: $values['contract_exp'] = $factoring->contract_exp;
        $values['fax'] ?: $values['fax'] = $factoring->fax;
        $values['advanced_rate'] ?: $values['advanced_rate'] = $factoring->advanced_rate;
        $values['reserve_ammount'] ?: $values['reserve_ammount'] = $factoring->reserve_ammount;
        $values['escrow_fee'] ?: $values['escrow_fee'] = $factoring->escrow_fee;
        $values['monthly_minimum'] ?: $values['monthly_minimum'] = $factoring->monthly_minimum;

        $factoring = tap($factoring)->update([
            'company_id' => $values['company_id'],
            'name' => $values['name'],
            'address' => $values['address'],
            'phone' => $values['phone'],
            'contract_exp' => $values['contract_exp'],
            'fax' => $values['fax'],
            'advanced_rate' => $values['advanced_rate'],
            'reserve_ammount' => $values['reserve_ammount'],
            'escrow_fee' => $values['escrow_fee'],
            'monthly_minimum' => $values['monthly_minimum'],
            
        ]);
        return $factoring;
    }
    
    public function destroy($factoring ,$values){
       $factoring['is_deleted'] =$values['is_deleted'];
        $factoring->save();
        return array('Cmmodity'=>$factoring);
    }
}
