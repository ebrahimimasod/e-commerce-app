<?php

namespace Modules\Favorite\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Favorite\Service\FavoriteService;

class FavoriteController extends Controller
{
    public function getUserFavorites()
    {
        return FavoriteService::index();
    }

    public function addProductToFavorite($product_id)
    {
        return FavoriteService::add($product_id);
    }
}
