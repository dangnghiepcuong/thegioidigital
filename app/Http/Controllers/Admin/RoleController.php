<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActionStatus;
use App\Enums\TableEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $tables = TableEnum::allCases();
        $roles = Role::paginate(15);

        $role = $request->role_id ? Role::findOrFail($request->role_id) : null;
        $rolePermissions = $request->role_id ? $role->permissions()->paginate(15) : null;

        return view('admin.roles', [
            'tables' => $tables,
            'roles' => $roles,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function store(CreateRoleRequest $request): RedirectResponse
    {
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with([
            'status' => ActionStatus::SUCCESS,
            'message' => __(
                'message.success',
                [
                    'action' => __('btn.import', [
                        'object' => __('vaccine.vaccine'),
                    ]),
                ],
            ),
        ]);;
    }
}
