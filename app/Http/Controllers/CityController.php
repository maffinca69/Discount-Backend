<?php


namespace App\Http\Controllers;


use App\Http\Requests\Cities\CityCreateRequest;
use App\Http\Requests\Cities\CityDeleteRequest;
use App\Http\Requests\Cities\CityUpdateRequest;
use App\Models\City;
use App\Presenters\CityPresenter;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $models = City::query()->paginate(self::PAGINATE_SIZE)->getCollection()->transform(function($model) {
            return CityPresenter::present($model);
        });

        return response()->json($models);
    }

    /**
     * @param CityCreateRequest $request
     * @return JsonResponse
     */
    public function create(CityCreateRequest $request): JsonResponse
    {
        if ($city = City::query()->create($request->all())) {
            return response()->json(CityPresenter::present($city), 201);
        }

        return response()->json(['status' => false], 500);
    }

    /**
     * @param CityUpdateRequest $request
     * @return JsonResponse
     */
    public function update(CityUpdateRequest $request)
    {
        if (City::query()->find($request->get('id'))->update($request->all())) {
            return response()->json(['status' => true], 200);
        }

        return response()->json(['status' => false], 500);
    }

    /**
     * @param CityDeleteRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(CityDeleteRequest $request)
    {
        if (City::query()->find($request->get('id'))->delete()) {
            return response()->json(['status' => true], 200);
        }

        return response()->json(['status' => false], 400);
    }
}
