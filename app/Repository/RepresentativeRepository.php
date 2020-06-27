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
            $representative = Representative::create([
                'factoring_id' =>$data['factoring_id'],
                'representative' =>$data['representative'],
                'rep_phone' =>$data['rep_phone'],
                'rep_email' =>$data['rep_email'],
                'payment_email' =>$data['payment_email'],
            ]);
        return $representative;
    }

    public function update($representative, $values){
        $values['factoring_id'] ?: $values['factoring_id'] = $representative->factoring_id;
        $values['representative'] ?: $values['representative'] = $representative->representative;
        $values['rep_phone'] ?: $values['rep_phone'] = $representative->rep_phone;
        $values['rep_email'] ?: $values['rep_email'] = $representative->rep_email;
        $values['payment_email'] ?: $values['payment_email'] = $representative->payment_email;

        $representative = tap($representative)->update([
            'factoring_id' => $values['factoring_id'],
            'representative' => $values['representative'],
            'rep_phone' => $values['rep_phone'],
            'rep_email' => $values['rep_email'],
            'payment_email' => $values['payment_email'],
        ]);
        return $representative;
    }
    
    public function destroy($representative ,$values){
       $representative['is_deleted'] =$values['is_deleted'];
        $representative->save();
        return array('Cmmodity'=>$representative);
    }
}
