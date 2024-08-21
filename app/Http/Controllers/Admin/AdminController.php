<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableEnum;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }
}
