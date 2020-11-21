<?php

namespace App\Models;

use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class City
 * @package App\Models
 *
 * @property int $id
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

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('id');
    }

}
