<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Commodity
 *
 * @property int $id
 * @property int $stop_id
 * @property string $description
 * @property string $Packaging
 * @property int $quantity
 * @property int $weight
 * @property bool $is_deleted
 *
 * @property Collection|Factoring[] $factoring
 *
 * @package App
 */

 /**
 * @OA\Schema(
 *     title="Commodity",
 *     description="Commodity model",
 *     @OA\Xml(
 *         name="Commodity"
 *     )
 * )
 */

class Commodity extends Model
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
     *     title="stop_id",
     *     description="stop_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $stop_id;

    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $description;

      /**
     * @OA\Property(
     *     title="Packaging",
     *     description="Packaging",
     *     format="string",
     *     example="string"
     * )
     *
     * @var string
     */
    private $Packaging;

     /**
     * @OA\Property(
     *     title="quantity",
     *     description="quantity",
     *     format="int",
     *     example=100
     * )
     *
     * @var int
     */
    private $quantity;

    /**
     * @OA\Property(
     *     title="weight",
     *     description="weight",
     *     format="int",
     *     example=100
     * )
     *
     * @var int
     */
    private $weight;

    /**
     * @OA\Property(
     *     title="is_deleted",
     *     description="is_deleted",
     *     format="bool",
     *     example=false
     * )
     *
     * @var bool
     */
    private $is_deleted;


    protected $fillable = [
        'stop_id',
        'description',
        'Packaging',
        'quantity',
        'weight',
    ];
    public function stop(){
        return $this->belongsTo(Stop::class);
    }
}
