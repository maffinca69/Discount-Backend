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
            // General
            'id' => $model->id,
            'name' => $model->name,
            'info' => $model->info,
            'description' => $model->description,

            'min_discount' => $model->min_discount,
            'max_discount' => $model->max_discount,

            // Relation
            'cities' => $model->cities->map(function ($model) {
                return CityPresenter::present($model);
            }),

            'addresses' => $model->addresses->map(function ($model) {
                return AddressPresenter::present($model);
            }),

            'categories' => $model->categories->map(function ($model) {
                return CategoryPresenter::present($model);
            }),

            // Other
            'created_at' => $model->created_at->format('d.m.y H:m'),
            'updated_at' => $model->updated_at->format('d.m.y H:m'),
        ];
    }
}
