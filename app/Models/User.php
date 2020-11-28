<?php


namespace App\Models;


use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property int $role
 * @property DateTime $email_confirmed_at
 * @property string $email
 * @property string $password
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class User extends Model implements JWTSubject, Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'users';

    public const ROLE_ADMIN = 2;
    public const ROLE_MODERATOR = 1;
    public const ROLE_USER = 0;

    public const ROLES = [
        self::ROLE_ADMIN => 'Администратор',
        self::ROLE_MODERATOR => 'Модератор',
        self::ROLE_USER => 'Пользователь'
    ];

    protected $fillable = [
        'password',
        'email',
        'last_seen_at',
        'email_confirmed_at'
    ];

    protected $hidden = [
        'password',
        'role'
    ];

    protected $guarded = [
        'id'
    ];

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function scopeFindByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Check email confirm
     *
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return !is_null($this->email_confirmed_at);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
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

}
