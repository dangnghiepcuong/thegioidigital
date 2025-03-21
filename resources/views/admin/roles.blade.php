@extends('layouts.admin.index')
@section('title', 'Roles Management')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/role-permission-grant.css')
@endsection

@section('content')
    <div id="page-roles">
        <!-- An unexamined life is not worth living. - Socrates -->
        <div class="layout-roles-management">
            <div class="holder-title"><span class="title">Title</span></div>
            <div class="layout-panel">
                <div class="panel-left">
                    <div class="holder-title">
                        <span class="title">Role List</span>
                    </div>
                    <ul class="list">
                        @foreach ($roles as $role)
                            <li class="item">
                                <a href="{{ route('admin.roles.index', $role->id) }}" class="role">
                                    <span>{{ $role->name }}</span>
                                    <span class="icon material-symbols-outlined">arrow_forward_ios</span>
                                </a>
                            </li>
                        @endforeach
                        <div style="height: 100px"></div>
                    </ul>
                    {{ $roles->links() }}
                    <div class="layout-bottom-control-panel">
                        <div class="holder-title"><span class="title">Create New Role</span></div>
                        <span class="panel-add-permissions">
                            <form method="POST" action="{{ route('admin.roles.store') }}">
                                @csrf
                                <label for="role-name">Role name: </label>
                                <input id="role-name" name="name" type="text">
                                <input id="btn-create-role" class="btn-add" type="submit" value="+" />
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
                    @if (isset($rolePermissions))
                        <ul class="list">
                            @foreach ($rolePermissions as $rolePermission)
                                <li class="item">
                                    <a href="#" class="permission">
                                        <span class="operation">{{ $rolePermission->operation }}</span>
                                        <span class="on">on</span>
                                        <span class="table">{{ $rolePermission->table }}</span>
                                        <span class="icon material-symbols-outlined">cancel</span>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                            <div style="height: 100px"></div>
                        </ul>
                        {{ $rolePermissions->links() }}
                    @endif
                    <div class="layout-bottom-control-panel">
                        <div class="holder-title"><span class="title">Grant More Permissions</span></div>
                        <span class="panel-add-permissions">
                            <span>Permission: </span>
                            <select name="" id="">
                                <option value="">create</option>
                                <option value="">read</option>
                                <option value="">update</option>
                                <option value="">delete</option>
                            </select>
                            <span>on table: </span>
                            <select name="" id="">
                                @foreach ($tables as $table)
                                    <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                            <input id="btn-add-permission" class="btn-add" type="submit" value="+" />
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
