@extends('layouts.admin.index')
@section('title', 'Grant Permissions')

@section('styles')
    @parent
    @vite($viewsDir . '/admin/role-permission-grant.css')
@endsection

@section('content')
    <div id="page-grant-to-user">
        <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
        <div class="layout-roles-management">
            <div class="holder-title"><span class="title">PERMISSIONS GRANTING</span></div>
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
                        @if (isset($users))
                            @foreach ($users as $user)
                                <li class="item">
                                    <a href="{{ route('admin.permissions.grant-to-user', $user->id) }}" class="item-row">
                                        <span>{{ $user->email }}</span>
                                        <button class="btn btn-arrow">
                                            <span class="icon material-symbols-outlined">arrow_forward_ios</span>
                                        </button>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="panel-right">
                    <div class="holder-title">
                        <span class="title">Granted Permissions
                            {{ isset($selectedUser->email) ? "to: $selectedUser->email" : null }}</span>
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
                    <ul class="list" id="list-user-permissions">
                        @if (isset($selectedUser) && isset($userPermissions))
                            <x-partial.permission-list-item :user-id="$selectedUser->id" :user-permissions="$userPermissions" />
                            @if ($userPermissions->hasMorePages())
                                <x-general.button.button-see-more :id="'btn-see-more-user-permissions'" :google-icon-name="'keyboard_arrow_down'" :btn-see-more="'Xem thêm ' .
                                    $userPermissions->total() -
                                    $userPermissions->count() .
                                    ' quyền'"
                                    :next-page="$userPermissions->currentPage() + 1" :last-page="$userPermissions->lastPage()" :total="$userPermissions->total()" :onclick="'getMoreUserPermissions(this, ' . $selectedUser->id . ')'" />
                            @endif
                        @endif
                    </ul>
                    @if ($selectedUser)
                        <div class="layout-control-panel">
                            <div class="holder-title"><span class="title">Grant More Permissions</span></div>
                            <span class="panel-add-permissions">
                                <form action="{{ route('admin.permissions.grant') }}" method="POST">
                                    @csrf
                                    <input name="user_id" type="hidden" value="{{ $selectedUser->id }}">
                                    <label>Permission: </label>
                                    <select name="operation" id="">
                                        @if (old('operation'))
                                            <option value="{{ old('operation') }}">{{ old('operation') }}</option>
                                        @endif
                                        @foreach ($operationsEnum as $operation)
                                            @if ($operation !== old('operation'))
                                                <option value="{{ $operation }}">{{ $operation }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>on table: </label>
                                    <select name="table" id="">
                                        @if (old('table'))
                                            <option value="{{ old('table') }}">{{ old('table') }}</option>
                                        @endif
                                        @foreach ($tablesEnum as $table)
                                            @if ($table !== old('table'))
                                                <option value="{{ $table }}">{{ $table }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-add">
                                        <span class="icon material-symbols-outlined">add</span>
                                    </button>
                                </form>
                            </span>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    @vite($viewsDir . '/admin/grant-to-user.js')
@endsection
