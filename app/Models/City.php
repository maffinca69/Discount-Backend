<?php

namespace App\Models;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 *
 * @property string $name
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'id'
    ];

}
