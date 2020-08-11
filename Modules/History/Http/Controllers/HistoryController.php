<?php

namespace Modules\History\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\History\Service\HistoryService;

class HistoryController extends Controller
{
    public function getUserHistories()
    {
        return HistoryService::index();
    }

    public function addProductToHistories($product_id)
    {
        return HistoryService::add($product_id);
    }
}
