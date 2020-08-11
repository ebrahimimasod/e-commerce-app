<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Http\Request\CreateCategoryRequest;
use Modules\Category\Http\Request\UpdateCategoryRequest;
use Modules\Category\Service\CategoryService;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        return CategoryService::index($request);
    }

    public function store(CreateCategoryRequest $request)
    {
        return CategoryService::store($request);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return CategoryService::update($request, $id);
    }

    public function destroy($id)
    {
        return CategoryService::destroy($id);
    }
}
