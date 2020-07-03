<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Position
 *
 * @property int $id
 * @property int $company_id
 * @property string $description
 * @property string $target
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="positions",
 *     description="Position model",
 *     @OA\Xml(
 *         name="positions"
 *     )
 * )
 */
class Position extends Model
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

     /**
     * @OA\Property(
     *     title="company_id",
     *     description="company_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $company_id;



    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     format="string",
     *     example="ClassA or Engineer"
     * )
     *
     * @var string
     */
    private $description;


    
    /**
     * @OA\Property(
     *     title="target",
     *     description="target",
     *     format="string",
     *     example="employee or driver"
     * )
     *
     * @var string
     */
    private $target;

 
    /**
     * @OA\Property(
     *     title="is_deleted",
     *     description="is_deleted",
     *     format="bool",
     *     example=false
     * )
     *
     * @var boolean
     */
    private $is_deleted;

    protected $fillable = [
        'description',
        'target',
        'company_id',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function drivers(){
        return $this->hasMany(Driver::class);
    }
}
