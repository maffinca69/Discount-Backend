<?php


namespace App\Models;


use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 *
 * @property string $name
 * @property string $logo_url
 * @property string $description
 * @property string $info
 *
 * @property int $max_discount
 * @property int $min_discount
 *
 * @property City[] $cities
 * @property Address[] $addresses
 * @property Category[] $categories
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = [
        'name',
        'logo_url',
        'info',
        'description',
        'max_discount',
        'min_discount'
    ];

    protected $guarded = [
        'id'
    ];

    /**
     * @return BelongsToMany
     */
    public function cities()
    {
        return $this->belongsToMany(City::class, 'partners_as_cities');
    }

    /**
     * @return BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'partners_as_addresses');
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'partners_as_categories');
    }
}
