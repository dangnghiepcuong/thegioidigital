<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ModelMetaKey;
use App\Enums\TableEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\GrantPermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\Eloquents\PermissionRepository;
use App\Repositories\Eloquents\UserMetaRepository;
use App\Repositories\Eloquents\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    private PermissionRepository $permissionRepository;
    private UserMetaRepository $userMetaRepository;
    private UserRepository $userRepository;

    public function __construct(
        PermissionRepository $permissionRepository,
        UserMetaRepository $userMetaRepository,
        UserRepository $userRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->userMetaRepository = $userMetaRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): View
    {
        return view('admin.permissions');
    }

    public function getUserPermissionItems(Request $request)
    {
        $userPermissionIds = $this->userMetaRepository
            ->getUnserializeMetaValue($request->user_id, ModelMetaKey::USER_PERMISSIONS);

        $userPermissions = $this->permissionRepository->whereIn('id', $userPermissionIds)
            ->orderBy('table')
            ->orderBy('operation')
            ->paginate(config('parameter.default_paginate_number'));

        return view('components.partial.permission-list-item', [
            'userId' => $request->user_id,
            'userPermissions' => PermissionResource::collection($userPermissions)
        ]);
    }

    public function grantToUser(Request $request): View
    {
        $tables = TableEnum::allCases();
        $users = $this->userRepository->paginateAll();

        $user = null;
        $userPermissions = null;
        if (isset($request->user_id)) {
            $user = $this->userRepository->findOrFail($request->user_id);

            $userPermissionIds = $this->userMetaRepository
                ->getUnserializeMetaValue($request->user_id, ModelMetaKey::USER_PERMISSIONS);

            $userPermissions = $this->permissionRepository->whereIn('id', $userPermissionIds)
                ->orderBy('table')
                ->orderBy('operation')
                ->paginate(config('parameter.default_paginate_number'));
        }

        return view('admin.grant-to-user', [
            'tables' => $tables,
            'userPermissions' => $userPermissions,
            'selectedUser' => $user,
            'users' => $users,
        ]);
    }

    public function grant(GrantPermissionRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $grantingPermission = $this->permissionRepository->model()->firstOrCreate([
                'operation' => $request->operation,
                'table' => $request->table
            ]);

            $userPermissionIds = $this->userMetaRepository
                ->getUnserializeMetaValue($request->user_id, ModelMetaKey::USER_PERMISSIONS);

            if (in_array($grantingPermission->id, $userPermissionIds)) {
                DB::rollBack();

                return redirect()->back()
                    ->with([])
                    ->withInput($request->input());
            }

            $grantPermissionIds = array_unique(array_merge($userPermissionIds, [$grantingPermission->id]), SORT_REGULAR);

            $this->userMetaRepository->updateOrCreate(
                ['key' => ModelMetaKey::USER_PERMISSIONS],
                ['value' => serialize($grantPermissionIds)]
            );
        } catch (\Exception $exception) {
            DB::rollBack();

            redirect()->back()
                ->with([])
                ->withInput($request->input());
        }

        DB::commit();

        return redirect()->back()
            ->with([])
            ->withInput($request->input());
    }

    public function revoke($permissionId, $userId): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $userPermissionIds = $this->userMetaRepository
                ->getUnserializeMetaValue($userId, ModelMetaKey::USER_PERMISSIONS);

            if (!in_array($permissionId, $userPermissionIds)) {
                DB::rollBack();

                return redirect()->back();
            }

            $key = array_search($permissionId, $userPermissionIds);
            unset($userPermissionIds[$key]);

            $this->userMetaRepository->updateOrCreate(
                ['key' => ModelMetaKey::USER_PERMISSIONS],
                ['value' => serialize($userPermissionIds)]
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with([]);
        }

        return redirect()->back()->with([]);
    }
}
