<?php


namespace App\Http\Controllers;


use App\Http\Requests\Partners\PartnerCreateRequest;
use App\Models\Partner;
use App\Presenters\PartnerGetListPresenter;
use App\Services\PartnerCreateService;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $models = Partner::query()->paginate(self::PAGINATE_SIZE)->getCollection()->transform(function($model) {
            return PartnerGetListPresenter::present($model);
        });

        return response()->json($models);
    }

    /**
     * @param PartnerCreateRequest $request
     * @return JsonResponse
     */
    public function create(PartnerCreateRequest $request)
    {
        $service = new PartnerCreateService();
        $partner = $service->handle($request);

        return response()->json(PartnerGetListPresenter::present($partner), Response::HTTP_CREATED);
    }
}
