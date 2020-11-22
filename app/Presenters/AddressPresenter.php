<?php


namespace App\Presenters;


use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class AddressPresenter implements PresenterInterface
{

    public static function present(Model $model): array
    {
        /** @var Address $model */
        return [
            'id' => $model->id,
            'house' => $model->house,
            'street' => $model->street,
            'contact_phone' => $model->contact_phone
        ];
    }
}
