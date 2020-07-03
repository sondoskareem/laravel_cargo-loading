<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Representative
 *
 * @property int $id
 * @property int $factoring_id
 * @property string $representative
 * @property int $rep_phone
 * @property string $rep_email
 * @property string $payment_email
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Representatives",
 *     description="representatives model",
 *     @OA\Xml(
 *         name="Representatives"
 *     )
 * )
 */
class Representative extends Model
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
     *     title="factoring_id",
     *     description="factoring_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $factoring_id;


     /**
     * @OA\Property(
     *     title="representative",
     *     description="representative",
     *     format="string",
     *     example="something"
     * )
     *
     * @var string
     */
    private $representative;


     /**
     * @OA\Property(
     *     title="rep_phone",
     *     description="rep_phone",
     *     format="int",
     *     example=077123456
     * )
     *
     * @var integer
     */
    private $rep_phone;

    /**
     * @OA\Property(
     *     title="rep_email",
     *     description="rep_email",
     *     format="string",
     *     example="email@e.com"
     * )
     *
     * @var string
     */
    private $rep_email;

    /**
     * @OA\Property(
     *     title="payment_email",
     *     description="payment_email",
     *     format="string",
     *     example="email@e.com"
     * )
     *
     * @var string
     */
    private $payment_email;


    protected $fillable = [
        'factoring_id',
        'representative',
        'rep_phone',
        'rep_email',
        'payment_email',
    ];
    public function factoring(){
        return $this->belongsTo(Factoring::class);
    }
}
