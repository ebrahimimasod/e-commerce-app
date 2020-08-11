<?php


namespace Modules\User\Service;
use DB;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\CreateManagerRequest;
use Modules\User\Http\Requests\UpdateManagerRequest;
use Modules\User\Transformers\Admin\ManagerResource;
use Modules\User\Transformers\Admin\ManagerResourceCollection;

class ManagerService
{
    public static function index()
    {
        $users = User::where('level',User::ADMIN_LEVEL['value'])->latest()->paginate(20);
        return new  ManagerResourceCollection($users);
    }

    public static function store(CreateManagerRequest $request)
    {
        $data = $request->validated();
        $data['level'] = User::ADMIN_LEVEL['value'];
        try {
            DB::beginTransaction();
            $user = User::create($data);
            /** @var User $user */
            $user->role()->attach($data['role']);
            DB::commit();

        } catch (\Throwable $exception) {
            DB::rollBack();
            \Log::error($exception);
        }

        return httpResponse([
            'message' => 'مدیر با موفقیت ذخیره شد.',
        ], 200);
    }

    public static function update(UpdateManagerRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        try {
            DB::beginTransaction();
            /** @var User $user */
            $user->update($data);
            $user->role()->sync($data['role']);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            \Log::error($exception);
        }
        return httpResponse([
            'message' => 'مدیر با موفقیت ویرایش شد.',
        ], 200);

    }

    public static function destroy($id,$force=false)
    {
        /** @var User $user */
        $user = User::withTrashed()->findOrFail($id);
        $force ?  $user->forceDelete() :  $user->delete();

        return httpResponse([
            'message' => ' مدیر با موفقیت حذف شد.',
        ], 200);
    }



}
