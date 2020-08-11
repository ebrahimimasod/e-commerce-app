<?php


namespace Modules\User\Service;


use Modules\User\Entities\User;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Transformers\Admin\UserResourceCollection;

class UserService
{
    public static function index()
    {
        $users = User::where('level', User::USER_LEVEL['value'])->latest()->paginate(20);
        return new UserResourceCollection($users);
    }


    public static function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['level'] = User::USER_LEVEL['value'];
        User::create($data);
        return httpResponse([
            'message' => 'کاربر با موفقیت ذخیره شد.',
        ], 200);
    }


    public static function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $user->update($data);
        return httpResponse([
            'message' => 'کاربر با موفقیت ویرایش شد.',
        ], 200);
    }


    public static function destroy($id, $force = false)
    {
        /** @var User $user */
        $user = User::withTrashed()->findOrFail($id);
        $force ? $user->forceDelete() : $user->delete();

        return httpResponse([
            'message' => ' کاربر با موفقیت حذف شد.',
        ], 200);
    }


}
