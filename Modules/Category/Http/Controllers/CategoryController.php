<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Category\Service\CategoryService;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return CategoryService::getCategories();
    }
}
