<?php

namespace Modules\Role\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Role\Http\Request\CreateRoleRequest;
use Modules\Role\Http\Request\UpdateRoleRequest;
use Modules\Role\Service\RoleService;

class RoleController extends Controller
{

    public function index()
    {
        return RoleService::getRoles();
    }


    public function getPermissions()
    {
        return RoleService::getPermissions();
    }


    public function store(CreateRoleRequest $request)
    {
        return RoleService::store($request);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        return RoleService::update($request,$id);
    }

    public function destroy($id)
    {
        return RoleService::destroy($id);
    }
}
