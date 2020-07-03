<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Stop
 *
 * @property int $id
 * @property int $load_id
 * @property string $load_type
 * @property string $stop_description
 * @property string $trailer_type
 * @property string $facility
 * @property string $address
 * @property int $phone
 * @property string $appointment_type
 * @property text $driver_work
 * @property text $facility_note
 * @property bool $is_deleted
 *
 * @property Collection|Load[] $loads
 * @property Collection|Commodity[] $commodities
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Stop",
 *     description="Stop model",
 *     @OA\Xml(
 *         name="Stop"
 *     )
 * )
 */
class Stop extends Model
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
     *     title="load_id",
     *     description="load_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $load_id;

    /**
     * @OA\Property(
     *     title="load_type",
     *     description="load_type",
     *     format="string",
     *     example="pick up or delivery"
     * )
     *
     * @var integer
     */
    private $load_type;

    /**
     * @OA\Property(
     *     title="stop_description",
     *     description="stop_description",
     *     format="string",
     *     example="pick up info"
     * )
     *
     * @var string
     */
    private $stop_description;

    /**
     * @OA\Property(
     *     title="trailer_type",
     *     description="trailer_type",
     *     format="string",
     *     example="live load or drop trailer"
     * )
     *
     * @var string
     */
    private $trailer_type;

    
    /**
     * @OA\Property(
     *     title="facility",
     *     description="facility",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $facility;


     
    /**
     * @OA\Property(
     *     title="address",
     *     description="address",
     *     format="string",
     *     example="alkarada 62 street"
     * )
     *
     * @var string
     */
    private $address;


     
    /**
     * @OA\Property(
     *     title="phone",
     *     description="phone",
     *     format="integer",
     *     example=0770123456
     * )
     *
     * @var integer
     */
    private $phone;

     
    /**
     * @OA\Property(
     *     title="appointment_type",
     *     description="appointment_type",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var string
     */
    private $appointment_type;


     
    /**
     * @OA\Property(
     *     title="driver_work",
     *     description="driver_work",
     *     format="string",
     *     example="*****"
     * )
     *
     * @var text
     */
    private $driver_work;


     
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


    /**
     * @OA\Property(
     *     title="facility_note",
     *     description="facility_note",
     *     format="string",
     *     example="any thing about facility"
     * )
     *
     * @var text
     */
    private $facility_note;

    protected $fillable = [
        'load_id',
        'load_type',
        'stop_description',
        'trailer_type',
        'facility',
        'address',
        'phone',
        'driver_work',
        'appointment_type',
        'facility_note',
    ];
    public function loads(){
        return $this->belongsTo(Load::class);
    }
    public function commodities(){
        return $this->hasMany(Commodity::class);
    }
}
