<?php


namespace App\Models;


use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property string $house
 * @property string $street
 * @property string $contact_phone
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'house', 'street', 'contact_phone'
    ];

    protected $guarded = [
        'id'
    ];

    public function setContactPhoneAttribute($value)
    {
        $this->attributes['contact_phone'] = $value ? removeMask($value) : $value;
    }
}
