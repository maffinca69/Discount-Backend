<?php


namespace App\Http\Controllers;


use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryDeleteRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Requests\Cities\CityDeleteRequest;
use App\Models\Category;
use App\Presenters\CategoryGetListPresenter;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::query()->paginate(self::PAGINATE_SIZE)->getCollection()->transform(function($model) {
            return CategoryGetListPresenter::present($model);
        });

        return response()->json($models);
    }

    /**
     * @param CategoryCreateRequest $request
     * @return JsonResponse
     */
    public function create(CategoryCreateRequest $request)
    {
        $category = Category::query()->create($request->all());

        return response()->json(CategoryGetListPresenter::present($category), Response::HTTP_CREATED);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request)
    {
        Category::query()->find($request->get('id'))->update($request->all());

        return response()->json(['status' => true]);
    }

    /**
     * @param CategoryDeleteRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(CategoryDeleteRequest $request)
    {
        Category::query()->find($request->get('id'))->delete();

        return response()->json(['status' => true]);
    }
}
