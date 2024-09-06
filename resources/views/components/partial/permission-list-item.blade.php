@foreach ($userPermissions as $userPermission)
    <li class="item">
        <form action="{{ route('admin.permissions.revoke', [$userPermission->id, $userId]) }}" method="POST" class="item-row">
            @csrf
            <span class="operation">{{ $userPermission->operation ?? null }}</span>
            <span class="on">on</span>
            <span class="table">{{ $userPermission->table ?? null }}</span>
            <button type="submit" class="btn btn-cancel" onclick="return confirm('Are you sure you want to delete?')">
                <span class="icon material-symbols-outlined">cancel</span>
            </button>
            </span>
        </form>
    </li>
@endforeach
