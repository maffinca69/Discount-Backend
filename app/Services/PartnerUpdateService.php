<?php


namespace App\Services;


use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Partner;
use Dingo\Api\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;

class PartnerUpdateService
{
    public function handle(FormRequest $request): Model
    {
        $cities = City::query()->find($request->get('cities', []));
        $categories = Category::query()->find($request->get('categories', []));
        $addresses = $request->get('addresses', []);
        $addressesModels = [];

        // Save addresses
        foreach ($addresses as $address) {
            $addressModels = new Address($address);
            array_push($addressesModels, $addressModels);
        }

        $partner = Partner::query()->find($request->get('id', 0));
        $partner->update($request->all());

        // Save relations
        $partner->cities()->detach();
        $partner->cities()->saveMany($cities);

        $partner->addresses()->detach();
        $partner->addresses()->saveMany($addressesModels);

        $partner->categories()->detach();
        $partner->categories()->saveMany($categories);

        return $partner;
    }
}
