<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\CreateManagerRequest;
use Modules\User\Http\Requests\UpdateManagerRequest;
use Modules\User\Service\ManagerService;

class ManagerController extends Controller
{

    public function index()
    {
        return ManagerService::index();
    }


    public function store(CreateManagerRequest $request)
    {
        return ManagerService::store($request);
    }


    public function update(UpdateManagerRequest $request, $id)
    {
     return ManagerService::update($request,$id);
    }

    public function destroy($id)
    {
        return ManagerService::destroy($id);
    }

    public function forceDelete($id)
    {
        return ManagerService::destroy($id,true);
    }
}
