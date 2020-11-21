<?php


namespace App\Http\Controllers;


use App\Http\Requests\Cities\CityCreateRequest;
use App\Http\Requests\Cities\CityDeleteRequest;
use App\Http\Requests\Cities\CityUpdateRequest;
use App\Models\City;
use App\Presenters\CityCreatePresenter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * @return LengthAwarePaginator
     */
    public function index()
    {
        // TODO: сделать кастомную пагинацию для МП
        return City::query()->paginate(self::PAGINATE_SIZE);
    }

    /**
     * @param CityCreateRequest $request
     * @return JsonResponse
     */
    public function create(CityCreateRequest $request): JsonResponse
    {
        if ($city = City::query()->create($request->all())) {
            return response()->json(CityCreatePresenter::present($city), 201);
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
