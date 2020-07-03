<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 *
 * @property int $id
 * @property int $user_id
 * @property int $position_id
 * @property int $company_id
 * @property string $birth
 * @property string $pay_rate_per_hour
 * @property string $education
 * @property string $profile_image
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Employee",
 *     description="Employee model",
 *     @OA\Xml(
 *         name="Employee"
 *     )
 * )
 */
class Employee extends Model
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
     * @var string
     */
    private $birth;

    /**
     * @OA\Property(
     *     title="pay_rate_per_hour",
     *     description="pay_rate_per_hour",
     *     format="int",
     *     example="date"
     * )
     *
     * @var int
     */
    private $pay_rate_per_hour;

    /**
     * @OA\Property(
     *     title="education",
     *     description="education",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $education;

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
        'position_id',
        'company_id',
        'birth',
        'pay_rate_per_hour',
        'education',
        'profile_image'
    ];
    protected static function bootE()
    {
        parent::boot();
        static::creating(function($model){
            $model->type = 'employee';
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function positions(){
        return $this->belongsTo(Position::class);
    }

    public function loads(){
        return $this->hasMany(Load::class);
    }

}
