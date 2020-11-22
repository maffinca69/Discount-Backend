<?php


namespace App\Presenters;


use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerGetListPresenter implements PresenterInterface
{

    public static function present(Model $model): array
    {
        /** @var Partner $model */
        return [
            'id' => $model->id,
            'name' => $model->name,
            'info' => $model->info,
            'description' => $model->description,

            'min_discount' => $model->min_discount,
            'max_discount' => $model->max_discount,

            'cities' => $model->cities,
            'addresses' => $model->addresses,
            'categories' => $model->categories,

            'created_at' => $model->created_at->format('d.m.y H:mm'),
            'updated_at' => $model->updated_at->format('d.m.y H:mm'),
        ];
    }
}
