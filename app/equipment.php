<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipment
 *
 * @property int $id
 * @property int $company_id
 * @property string $car_type
 * @property string $plate
 * @property string $state
 * @property string $make
 * @property string $model
 * @property string $color
 * @property string $year
 * @property string $service_type
 * @property string $vin_number
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Equipment",
 *     description="Equipment model",
 *     @OA\Xml(
 *         name="Equipment"
 *     )
 * )
 */
class Equipment extends Model
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
     * @var integer
     */
    private $company_id;

    /**
     * @OA\Property(
     *     title="car_type",
     *     description="car_type",
     *     format="string",
     *     example="****"
     * )
     *
     * @var string
     */
    private $car_type;

    /**
     * @OA\Property(
     *     title="plate",
     *     description="plate",
     *     format="string",
     *     example="****"
     * )
     *
     * @var string
     */
    private $plate;

    
    /**
     * @OA\Property(
     *     title="state",
     *     description="state",
     *     format="string",
     *     example="****"
     * )
     *
     * @var string
     */
    private $state;

    
    /**
     * @OA\Property(
     *     title="make",
     *     description="make",
     *     format="string",
     *     example="****"
     * )
     *
     * @var string
     */
    private $make;

    
    /**
     * @OA\Property(
     *     title="model",
     *     description="model",
     *     format="string",
     *     example="any string"
     * )
     *
     * @var string
     */
    private $model;

     /**
     * @OA\Property(
     *     title="color",
     *     description="color",
     *     format="string",
     *     example="any color"
     * )
     *
     * @var string
     */
    private $color;

     /**
     * @OA\Property(
     *     title="year",
     *     description="year",
     *     format="string",
     *     example="any date"
     * )
     *
     * @var string
     */
    private $year;

    /**
     * @OA\Property(
     *     title="service_type",
     *     description="service_type",
     *     format="string",
     *     example="any string"
     * )
     *
     * @var string
     */
    private $service_type;

     /**
     * @OA\Property(
     *     title="vin_number",
     *     description="vin_number",
     *     format="string",
     *     example="any string"
     * )
     *
     * @var string
     */
    private $vin_number;

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
        'car_type',
        'plate',
        'company_id',
        'state',
        'make',
        'model',
        'color',
        'year',
        'service_type',
        'vin_number',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
