<?php

namespace Modules\Promotion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Promotion\Http\Requests\CreatePromotionRequest;
use Modules\Promotion\Http\Requests\UpdatePromotionRequest;
use Modules\Promotion\Service\PromotionService;

class PromotionController extends Controller
{

    public function index()
    {
        return PromotionService::index();
    }


    public function store(CreatePromotionRequest $request)
    {
        return PromotionService::store($request);
    }


    public function update(UpdatePromotionRequest $request, $id)
    {
        return PromotionService::update($request,$id);
    }

    public function destroy($id)
    {
        return PromotionService::destroy($id);
    }
}
