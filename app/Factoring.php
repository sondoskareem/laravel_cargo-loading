<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Factoring
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $address
 * @property int $phone
 * @property string $fax
 * @property string $contract_exp
 * @property int $advanced_rate
 * @property int $reserve_ammount
 * @property int $escrow_fee
 * @property int $monthly_minimum
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Factoring",
 *     description="Factoring model",
 *     @OA\Xml(
 *         name="Factoring"
 *     )
 * )
 */
class Factoring extends Model
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
     *     title="name",
     *     description="name",
     *     format="string",
     *     example="ANY"
     * )
     *
     * @var string
     */
    private $name;

    
    /**
     * @OA\Property(
     *     title="address",
     *     description="address",
     *     format="string",
     *     example="ANY ADDRESS"
     * )
     *
     * @var string
     */
    private $address;

     /**
     * @OA\Property(
     *     title="phone",
     *     description="phone",
     *     format="int",
     *     example="ANY phone"
     * )
     *
     * @var int
     */
    private $phone;


     /**
     * @OA\Property(
     *     title="fax",
     *     description="fax",
     *     format="string",
     *     example="ANY fax"
     * )
     *
     * @var int
     */
    private $fax;

    /**
     * @OA\Property(
     *     title="contract_exp",
     *     description="contract exp date",
     *     format="string",
     *     example="ANY date"
     * )
     *
     * @var string
     */
    private $contract_exp;

     /**
     * @OA\Property(
     *     title="advanced_rate",
     *     description="advanced_rate",
     *     format="int",
     *     example=1
     * )
     *
     * @var int
     */
    private $advanced_rate;

    /**
     * @OA\Property(
     *     title="reserve_ammount",
     *     description="reserve_ammount",
     *     format="int",
     *     example=1
     * )
     *
     * @var int
     */
    private $reserve_ammount;

    /**
     * @OA\Property(
     *     title="escrow_fee",
     *     description="escrow_fee",
     *     format="int",
     *     example=1
     * )
     *
     * @var int
     */
    private $escrow_fee;

    /**
     * @OA\Property(
     *     title="monthly_minimum",
     *     description="monthly_minimum",
     *     format="int",
     *     example=1
     * )
     *
     * @var int
     */
    private $monthly_minimum;

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
        'name',
        'address',
        'company_id',
        'phone',
        'fax',
        'contract_exp',
        'advanced_rate',
        'reserve_ammount',
        'escrow_fee',
        'monthly_minimum',
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function representatives(){
        return $this->hasMany(Representative::class);
    }
}
