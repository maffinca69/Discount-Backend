<?php


namespace App\Presenters;


use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class CityPresenter implements PresenterInterface
{

    public static function present(Model $model): array
    {
        /** @var City $model */
        return [
            'name' => $model->name,
            'id' => $model->id,
            'created_at' => $model->created_at->format('d.m.Y H:m'),
            'updated_at' => $model->updated_at->format('d.m.Y H:m'),
        ];
    }
}
