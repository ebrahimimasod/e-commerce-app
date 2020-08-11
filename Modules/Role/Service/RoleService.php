<?php


namespace Modules\Role\Service;


use DB;
use Log;
use Modules\Role\Entities\Permission;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Request\CreateRoleRequest;
use Modules\Role\Http\Request\UpdateRoleRequest;
use Modules\Role\Transformers\PermissionResourceCollection;
use Modules\Role\Transformers\RoleResourceCollection;

class RoleService
{

    public static function getRoles()
    {
        $roles = Role::get();
        return new RoleResourceCollection($roles);
    }


    public static function store(CreateRoleRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            /** @var Role $role */
            $role = Role::create($data);
            $role->permissions()->attach($data['permissions']);
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollBack();
        }

        return httpResponse([
            'message' => ' با موفقیت ذخیره شد.',
        ], 200);
    }


    public static function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validated();
        try {
            DB::beginTransaction();
            /** @var Role $role */
            $role->update($data);
            $role->permissions()->sync($data['permissions']);
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollBack();
        }

        return httpResponse([
            'message' => ' با موفقیت ویرایش شد.',
        ], 200);
    }


    public static function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return httpResponse([
            'message' => '  با موفقیت حذف شد.',
        ], 200);
    }

    public static function getPermissions()
    {
        $permissions = Permission::get();
        return new PermissionResourceCollection($permissions);
    }
}
