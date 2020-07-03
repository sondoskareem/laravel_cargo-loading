<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Driver
 *
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property int $company_id
 * @property string $birth
 * @property string $home_terminal
 * @property string $dl_hash
 * @property string $state
 * @property string $endorsements
 * @property bool $hazmat
 * @property bool $tanker
 * @property bool $double_triple
 * @property string $dl_exp
 * @property string $medical_exp
 * @property int $pay_rate
 * @property string $profile_image
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Driver",
 *     description="Driver model",
 *     @OA\Xml(
 *         name="Driver"
 *     )
 * )
 */

class Driver extends Model
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
     *     title="position_id",
     *     description="position_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $position_id;

    
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
     *     title="birth",
     *     description="birth",
     *     format="string",
     *     example="date"
     * )
     *
     * @var integer
     */
    private $birth;

    /**
     * @OA\Property(
     *     title="home_terminal",
     *     description="home_terminal",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $home_terminal;

    /**
     * @OA\Property(
     *     title="dl_hash",
     *     description="dl_hash",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $dl_hash;

    /**
     * @OA\Property(
     *     title="state",
     *     description="state",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $state;

    /**
     * @OA\Property(
     *     title="endorsements",
     *     description="endorsements",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $endorsements;

    /**
     * @OA\Property(
     *     title="hazmat",
     *     description="hazmat",
     *     format="bool",
     *     example="false"
     * )
     *
     * @var bool
     */
    private $hazmat;


    /**
     * @OA\Property(
     *     title="tanker",
     *     description="tanker",
     *     format="bool",
     *     example="false"
     * )
     *
     * @var bool
     */
    private $tanker;

    /**
     * @OA\Property(
     *     title="double_triple",
     *     description="double_triple",
     *     format="bool",
     *     example="false"
     * )
     *
     * @var bool
     */
    private $double_triple;

    /**
     * @OA\Property(
     *     title="dl_exp",
     *     description="dl_exp",
     *     format="string",
     *     example="date"
     * )
     *
     * @var string
     */
    private $dl_exp;

    /**
     * @OA\Property(
     *     title="medical_exp",
     *     description="medical_exp",
     *     format="string",
     *     example="date"
     * )
     *
     * @var string
     */
    private $medical_exp;

    /**
     * @OA\Property(
     *     title="pay_rate",
     *     description="pay_rate",
     *     format="int",
     *     example=10
     * )
     *
     * @var int
     */
    private $pay_rate;

    /**
     * @OA\Property(
     *     title="profile_image",
     *     description="profile_image",
     *     format="string",
     *     example="img.jpg"
     * )
     *
     * @var string
     */
    private $profile_image;

    protected $fillable = [
        'user_id',
        'company_id',
        'position_id',
        'birth',
        'home_terminal',
        'dl_hash',
        'state',
        'endorsements',
        'hazmat',
        'tanker',
        'double_triple',
        'dl_exp',
        'medical_exp',
        'pay_rate',
        'profile_image',
    ];
    protected static function bootE()
    {
        parent::boot();
        static::creating(function($model){
            $model->type = 'driver';
        });
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
