<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @property int $id
 * @property int $user_id
 * @property string $mc_number
 * @property string $dot_number
 * @property string $website
 * @property bool $invoive_factoring_approvment
 * @property bool $invoice_mail
 * @property int $personal_fax
 * @property int $business_fax
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Xml(
 *         name="Customer"
 *     )
 * )
 */

class Customer extends Model
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
     *     title="user_id",
     *     description="user_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $user_id;

     /**
     * @OA\Property(
     *     title="mc_number",
     *     description="mc_number",
     *     format="string",
     *     example="String"
     * )
     *
     * @var string
     */
    private $mc_number;

    /**
     * @OA\Property(
     *     title="dot_number",
     *     description="dot_number",
     *     format="string",
     *     example="String"
     * )
     *
     * @var string
     */
    private $dot_number;

     /**
     * @OA\Property(
     *     title="website",
     *     description="website",
     *     format="string",
     *     example="String"
     * )
     *
     * @var string
     */
    private $website;

    /**
     * @OA\Property(
     *     title="invoive_factoring_approvment",
     *     description="invoive_factoring_approvment",
     *     format="bool",
     *     example=false
     * )
     *
     * @var bool
     */
    private $invoive_factoring_approvment;

    /**
     * @OA\Property(
     *     title="invoice_mail",
     *     description="invoice_mail",
     *     format="bool",
     *     example=false
     * )
     *
     * @var bool
     */
    private $invoice_mail;

    /**
     * @OA\Property(
     *     title="personal_fax",
     *     description="personal_fax",
     *     format="int",
     *     example=231131
     * )
     *
     * @var int
     */
    private $personal_fax;

    /**
     * @OA\Property(
     *     title="business_fax",
     *     description="business_fax",
     *     format="int",
     *     example=231131
     * )
     *
     * @var int
     */
    private $business_fax;


    protected $fillable = [
        'user_id',
        'mc_number',
        'dot_number',
        'website',
        'invoive_factoring_approvment',
        'invoice_mail',
        'personal_fax',
        'business_fax',
    ];
  
    // protected static function boot()
    // {
    //     parent::boot();

    //     // auto-sets values on creation
    //     static::creating(function ($query) {
    //         $query->type = 'customer';
    //         $query->password = bcrypt('password');
    //     });
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loads(){
        return $this->hasMany(Load::class);
    }
}
