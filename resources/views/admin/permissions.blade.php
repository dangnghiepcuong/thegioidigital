@extends('layouts.admin.index')
@section('title', 'Permissions Management')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/role-permission-grant.css')
@endsection

@section('content')
    <div id="page-permissions">
        <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
        <div class="layout-roles-management">
            <div class="holder-title"><span class="title">ROLES MANAGEMENT</span></div>
            <div class="layout-panel">
                <div class="panel-left">
                    <div class="holder-title">
                        <span class="title">User List</span>
                    </div>
                    <div class="layout-control-panel">
                        <div class="holder-title"><span class="title">Sort & Filter</span></div>
                        <span class="panel-add-permissions">
                            <label>Permission: </label>
                            <select name="" id="">
                                <option value=""></option>
                                @foreach ($operationsEnum as $operation)
                                    <option value="{{ $operation }}">{{ $operation }}</option>
                                @endforeach
                            </select>
                            <label>on table: </label>
                            <select name="" id="">
                                <option value=""></option>
                                @foreach ($tablesEnum as $table)
                                    <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-add" type="submit">
                                <span class="icon material-symbols-outlined">check_small</span>
                            </button>
                        </span>
                    </div>
                    <ul class="list">
                        @if (isset($roles))
                            @foreach ($roles as $role)
                                <li class="item">
                                    <a href="{{ route('admin.roles.index', $role->id) }}" class="role">
                                        <span>{{ $role->name }}</span>
                                        <button class="btn btn-arrow">
                                            <span class="icon material-symbols-outlined">arrow_forward_ios</span>
                                        </button>
                                    </a>
                                </li>
                            @endforeach
                            {{ $roles->links() }}
                        @endif
                    </ul>
                    <div class="layout-control-panel">
                        <div class="holder-title"><span class="title">Create New Role</span></div>
                        <span class="panel-add-permissions">
                            <form method="POST" action="{{ route('admin.roles.store') }}">
                                @csrf
                                <label for="role-name">Role name: </label>
                                <input id="role-name" name="name" type="text">
                                <button class="btn btn-add" type="submit">
                                    <span class="icon material-symbols-outlined">add</span>
                                </button>
                            </form>
                        </span>
                        <div class="layout-validation-errors">
                            @foreach ($errors->all() as $error)
                                <span class="error">{{ $error }}</span>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-right">
                    <div class="holder-title">
                        <span class="title">Granted Permissions</span>
                    </div>
                    <div class="layout-control-panel">
                        <div class="holder-title"><span class="title">Sort & Filter</span></div>
                        <span class="panel-add-permissions">
                            <label>Permission: </label>
                            <select name="" id="">
                                <option value=""></option>
                                @foreach ($operationsEnum as $operation)
                                    <option value="{{ $operation }}">{{ $operation }}</option>
                                @endforeach
                            </select>
                            <label>on table: </label>
                            <select name="" id="">
                                <option value=""></option>
                                @foreach ($tablesEnum as $table)
                                    <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-add" type="submit">
                                <span class="icon material-symbols-outlined">check_small</span>
                            </button>
                        </span>
                    </div>
                    <ul class="list">
                        @if (isset($rolePermissions))
                            @foreach ($rolePermissions as $rolePermission)
                                <li class="item">
                                    <form href="#" class="item-row">
                                        <span class="operation">{{ $rolePermission->operation }}</span>
                                        <span class="on">on</span>
                                        <span class="table">{{ $rolePermission->table }}</span>
                                        <span class="icon material-symbols-outlined">cancel</span>
                                        </span>
                                    </form>
                                </li>
                                {{ $rolePermissions->links() }}
                            @endforeach
                        @endif
                    </ul>
                    <div class="layout-control-panel">
                        <div class="holder-title"><span class="title">Grant More Permissions</span></div>
                        <span class="panel-add-permissions">
                            <label>Permission: </label>
                            <select name="" id="">
                                @foreach ($operationsEnum as $operation)
                                    <option value="{{ $operation }}">{{ $operation }}</option>
                                @endforeach
                            </select>
                            <label>on table: </label>
                            <select name="" id="">
                                @foreach ($tablesEnum as $table)
                                    <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-add" type="submit">
                                <span class="icon material-symbols-outlined">add</span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
