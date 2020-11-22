<?php


namespace App\Services;


use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Partner;
use Dingo\Api\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;

class PartnerCreateService
{
    public function handle(FormRequest $request): Model
    {
        $cities = City::query()->find($request->get('cities'));
        $categories = Category::query()->find($request->get('categories'));
        $addresses = $request->get('addresses');
        $addressesModels = [];

        // Save addresses
        foreach ($addresses as $address) {
            $addressModels = new Address($address);
            array_push($addressesModels, $addressModels);
        }

        $partner = Partner::query()->create($request->all());
        $partner->cities()->saveMany($cities);
        $partner->addresses()->saveMany($addressesModels);
        $partner->categories()->saveMany($categories);

        return $partner;
    }
}
