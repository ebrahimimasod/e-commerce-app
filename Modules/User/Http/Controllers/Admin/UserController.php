<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Service\UserService;

class UserController extends Controller
{

    public function index()
    {
        return UserService::index();
    }


    public function store(CreateUserRequest $request)
    {
        return UserService::store($request);
    }


    public function update(UpdateUserRequest $request, $id)
    {
     return UserService::update($request,$id);
    }

    public function destroy($id)
    {
        return UserService::destroy($id);
    }

    public function forceDelete($id)
    {
        return UserService::destroy($id,true);
    }
}
