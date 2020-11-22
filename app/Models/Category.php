<?php


namespace App\Models;


use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 *
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'icon'
    ];

    protected $guarded = [
        'id'
    ];
}
