<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModelMetaKey;
use App\Enums\TableEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\GrantPermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.permissions');
    }

    public function getUserPermissionItems(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $userMetaPermissions = $user->userMeta()
            ->where('key', ModelMetaKey::USER_PERMISSIONS)
            ->firstOrFail();

        $userPermissionIds = $userMetaPermissions ? unserialize($userMetaPermissions->value) : [];

        $userPermissions = Permission::whereIn('id', $userPermissionIds)
            ->orderBy('table')
            ->orderBy('operation')
            ->paginate(config('parameter.default_paginate_number'));

        return view('components.partial.permission-list-item', [
            'userId' => $user->id,
            'userPermissions' => PermissionResource::collection($userPermissions)
        ]);
    }

    public function grantToUser(Request $request): View
    {
        $tables = TableEnum::allCases();
        $users = User::paginate(
            $perPage = config('parameter.default_paginate_number'),
            $columns = ['*'],
            $pageName = 'users',
        );

        $user = null;
        if (isset($request->user_id)) {
            $user = User::findOrFail($request->user_id);
        }

        $userMetaPermission = $request->user_id ? $user->userMeta(ModelMetaKey::USER_PERMISSIONS)->first() : null;

        $userPermissionIds = $userMetaPermission ? unserialize($userMetaPermission->value) : [];

        $userPermissions = Permission::whereIn('id', $userPermissionIds)
            ->orderBy('table')
            ->orderBy('operation')
            ->paginate(config('parameter.default_paginate_number'));

        return view('admin.grant-to-user', [
            'tables' => $tables,
            'userPermissions' => PermissionResource::collection($userPermissions),
            'selectedUser' => $user,
            'users' => $users,
        ]);
    }

    public function grant(GrantPermissionRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $grantingPermission = Permission::firstOrCreate([
                'operation' => $request->operation,
                'table' => $request->table
            ]);

            $user = User::findOrFail($request->user_id);

            $userMetaPermission = $user->userMeta(ModelMetaKey::USER_PERMISSIONS)->first();

            $userPermissionIds = $userMetaPermission ? unserialize($userMetaPermission->value) : [];

            if (in_array($grantingPermission->id, $userPermissionIds)) {
                DB::rollBack();

                return redirect()->back()->withInput($request->input());
            }

            $grantPermissionIds = array_unique(array_merge($userPermissionIds, [$grantingPermission->id]), SORT_REGULAR);

            $user->userMeta()->updateOrCreate(
                ['key' => ModelMetaKey::USER_PERMISSIONS],
                ['value' => serialize($grantPermissionIds)]
            );
        } catch (\Exception $exception) {
            DB::rollBack();

            throw ($exception);
            redirect()->back()
                ->with([])
                ->withInput($request->input());
        }

        DB::commit();

        return redirect()->back()->withInput($request->input());
    }

    public function revoke(Request $request, $permissionId, $userId): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);

            $userMetaPermission = $user->userMeta(ModelMetaKey::USER_PERMISSIONS)->first();

            $userPermissionIds = $userMetaPermission ? unserialize($userMetaPermission->value) : [];

            if (!in_array($permissionId, $userPermissionIds)) {
                DB::rollBack();

                return redirect()->back();
            }

            $key = array_search($permissionId, $userPermissionIds);
            unset($userPermissionIds[$key]);

            $user->userMeta()->updateOrCreate(
                ['key' => ModelMetaKey::USER_PERMISSIONS],
                ['value' => serialize($userPermissionIds)]
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            dump($exception);
            throw ($exception);
        }
        return redirect()->back();
    }
}
