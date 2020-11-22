<?php


namespace App\Presenters;


use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerPresenter implements PresenterInterface
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

            'cities' => $model->cities->map(function ($city) {
                return CityPresenter::present($city);
            }),

            'addresses' => $model->addresses,
            'categories' => $model->categories,

            'created_at' => $model->created_at->format('d.m.y H:m'),
            'updated_at' => $model->updated_at->format('d.m.y H:m'),
        ];
    }
}
