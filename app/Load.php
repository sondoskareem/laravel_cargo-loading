<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Load
 *
 * @property int $id
 * @property int $customer_id
 * @property int $employee_id
 * @property string $po_load
 * @property int $load_rate
 * @property int $loaded_mile
 * @property string $load_type
 * @property string $trailer_type
 * @property bool $endorsements
 * @property int $number_of_stop
 * @property string $trailer_model
 * @property string $status
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Load",
 *     description="Load model",
 *     @OA\Xml(
 *         name="load"
 *     )
 * )
 */
class Load extends Model
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
     *     title="customer_id",
     *     description="customer_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $customer_id;
      /**
     * @OA\Property(
     *     title="employee_id",
     *     description="employee_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $employee_id;

    /**
     * @OA\Property(
     *     title="po_load",
     *     description="po_load",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $po_load;


    /**
     * @OA\Property(
     *     title="load_rate",
     *     description="load_rate",
     *     format="int",
     *     example=3
     * )
     *
     * @var int
     */
    private $load_rate;


      /**
     * @OA\Property(
     *     title="loaded_mile",
     *     description="loaded_mile",
     *     format="int",
     *     example=12
     * )
     *
     * @var int
     */
    private $loaded_mile;



    /**
     * @OA\Property(
     *     title="load_type",
     *     description="load_type",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $load_type;

    /**
     * @OA\Property(
     *     title="trailer_type",
     *     description="trailer_type",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $trailer_type;

    /**
     * @OA\Property(
     *     title="endorsements",
     *     description="endorsements",
     *     format="bool",
     *     example="*****"
     * )
     *
     * @var bool
     */
    private $endorsements;

    /**
     * @OA\Property(
     *     title="number_of_stop",
     *     description="number_of_stop min 2 ",
     *     format="int",
     *     example=2
     * )
     *
     * @var int
     */
    private $number_of_stop;

     /**
     * @OA\Property(
     *     title="trailer_model",
     *     description="trailer_model min 2 ",
     *     format="string",
     *     example="***"
     * )
     *
     * @var string
     */
    private $trailer_model;

    /**
     * @OA\Property(
     *     title="status",
     *     description="status min 2 ",
     *     format="string",
     *     example="***"
     * )
     *
     * @var string
     */
    private $status;

 
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
        'customer_id',
        'employee_id',
        'po_load',
        'load_rate',
        'loaded_mile',
        'load_type',
        'trailer_type',
        'endorsements',
        'number_of_stop',
        'trailer_model',
        'status',
    ];

    public function stops(){
        return $this->hasMany(Stop::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    
}
