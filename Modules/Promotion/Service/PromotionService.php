<?php

namespace Modules\Promotion\Service;

use Modules\Promotion\Entities\Promotion;
use Modules\Promotion\Http\Requests\CreatePromotionRequest;
use Modules\Promotion\Http\Requests\UpdatePromotionRequest;

class PromotionService
{
    public static function index()
    {
        return Promotion::latest()->paginate(20);
    }

    public static function store(CreatePromotionRequest $request)
    {
        $data = $request->validated();
        Promotion::create($data);
        return httpResponse('با موفقیت ساخته شد.');
    }

    public static function update(UpdatePromotionRequest $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $data = $request->validated();
        $promotion->update($data);
        return httpResponse('با موفقیت ویرایش شد.');
    }

    public static function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return httpResponse('با موفقیت حذف شد.');

    }
}
