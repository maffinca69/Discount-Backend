<?php


namespace App\Presenters;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryPresenter implements PresenterInterface
{

    public static function present(Model $model): array
    {
        /** @var Category $model */
        return [
            'id' => $model->id,
            'name' => $model->name,
            'icon' => $model->icon,
            'created_at' => $model->created_at->format('d.m.Y H:m'),
            'updated_at' => $model->updated_at->format('d.m.Y H:m'),
        ];
    }
}
