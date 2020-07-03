<?php

namespace App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string $personal_phone
 * @property string $business_phone
 * @property string $type
 * @property string $address
 * @property string $status
 * @property string $date
 * @property string $note
 * @property bool $is_deleted
 *
 * @property Collection|Employee[] $employees
 * @property Collection|Customer[] $customers
 * @property Collection|Driver[] $drivers
 *
 * @package App\Core\Models
 */

 /**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
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
     *      title="name",
     *      description="name of the new User",
     *      example="Ahmed"
     * )
     *
     * @var string
     */
    private $name;
    /**
     * @OA\Property(
     *      title="email",
     *      description="email of the new User",
     *      example="email@email.com",
	 *      type="string"
     * )
     * @var integer
     */
    private $email;
    
    /**
     * @OA\Property(
     *      title="personal_phone",
     *      description="personal_phone of the new User",
     *      example="0770123456",
	 *      type="string"
     * )
     *
     */
    private $personal_phone;
    
    /**
     * @OA\Property(
     *      title="business_phone",
     *      description="business_phone of the new User",
     *      example="0770123456",
	 *      type="string"
     * )
     *
     */
    private $business_phone;
    /**
     * @OA\Property(
     *      title="password",
     *      description="password of the new User",
     *      example="32134",
	 *      type="string"
     * )
     *
     */
    private $password;
    /**
     * @OA\Property(
     *      title="type",
     *      description="type of the new User",
     *      example="admin",
	 *      type="string"
     * )
     *
     */
    
    private $type;
    
    /**
     * @OA\Property(
     *      title="address",
     *      description="address of the new User",
     *      example="Baghdad/alkaradaa 62 Street",
	 *      type="string"
     * )
     *
     */
    private $address;
    
  /**
     * @OA\Property(
     *      title="date",
     *      description=" signIn date or hiring date ",
     *      example="2/2/2020",
	 *      type="string"
     * )
     *
     */
    private $date;
    /**
     * @OA\Property(
     *      title="status",
     *      description="status of the new User",
     *      example="active",
	 *      type="string"
     * )
     *
     */
    private $status;

    /**
     * @OA\Property(
     *      title="is_deleted",
     *      description="is_deleted determain if the user deleted or not",
     *      example="true",
	 *      type="boolean"
     * )
     *
     */
    private $is_deleted;

    /**
     * @OA\Property(
     *      title="note",
     *      description="note about the user",
     *      example="true",
	 *      type="boolean"
     * )
     *
     */
    private $note;

    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'personal_phone',
        'business_phone',
        'password',
        'address',
        'date',
        'note',
        'type',
        'status',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function setUserTypeAttribute($value)
    { 
        $this->attributes['password'] = empty($value) ? bcrypt('password') : $value;
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function employees(){
        return $this->hasOne(Employee::class);
    }

    public function drivers(){
        return $this->hasOne(Driver::class);
    }

    public function customers(){
        return $this->hasOne(Customer::class);
    }

}
