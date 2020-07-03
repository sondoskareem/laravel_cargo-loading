<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Company
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property string $email
 * @property string $first_address
 * @property string $second_address
 * @property int $fax
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Company",
 *     description="Company model",
 *     @OA\Xml(
 *         name="Company"
 *     )
 * )
 */

class Company extends Model
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
     *     title="name",
     *     description="name",
     *     format="string",
     *     example="CompanyNAme"
     * )
     *
     * @var string
     */
    private $name;

     /**
     * @OA\Property(
     *     title="phone",
     *     description="phone",
     *     format="int",
     *     example="Companyphone"
     * )
     *
     * @var int
     */
    private $phone;


    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="Companyemail"
     * )
     *
     * @var string
     */
    private $email;


     /**
     * @OA\Property(
     *     title="first_address",
     *     description="first_address",
     *     format="string",
     *     example="Companyfirst_address"
     * )
     *
     * @var string
     */
    private $first_address;

    /**
     * @OA\Property(
     *     title="second_address",
     *     description="second_address",
     *     format="string",
     *     example="Companysecond_address"
     * )
     *
     * @var string
     */
    private $second_address;

     /**
     * @OA\Property(
     *     title="fax",
     *     description="fax",
     *     format="int",
     *     example="Companyfax"
     * )
     *
     * @var int
     */
    private $fax;

    
     /**
     * @OA\Property(
     *     title="is_deleted",
     *     description="is_deleted",
     *     format="bool",
     *     example="is_deleted"
     * )
     *
     * @var bool
     */
    private $is_deleted;


    protected $fillable = [
        'name',
        'phone',
        'email',
        'first_address',
        'second_address',
        'fax'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function drivers(){
        return $this->hasMany(Driver::class);
    }

    public function equipments(){
        return $this->hasMany(Equipment::class);
    }

    public function factorings(){
        return $this->hasMany(Factoring::class);
    }
}
