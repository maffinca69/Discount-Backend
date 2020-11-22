<?php


namespace App\Http\Controllers;


use App\Http\Requests\Partners\PartnerCreateRequest;
use App\Http\Requests\Partners\PartnerDeleteRequest;
use App\Http\Requests\Partners\PartnerUpdateRequest;
use App\Models\Partner;
use App\Presenters\PartnerGetListPresenter;
use App\Services\PartnerCreateService;
use App\Services\PartnerUpdateService;
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

    /**
     * @param PartnerUpdateRequest $request
     * @return JsonResponse
     */
    public function update(PartnerUpdateRequest $request)
    {
        $service = new PartnerUpdateService();
        $partner = $service->handle($request);

        return response()->json(PartnerGetListPresenter::present($partner), Response::HTTP_OK);
    }

    /**
     * @param PartnerDeleteRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(PartnerDeleteRequest $request)
    {
        Partner::query()->find($request->get('id'))->delete();

        return response()->json(['status' => true], Response::HTTP_OK);
    }
}
