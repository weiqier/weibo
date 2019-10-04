<div class="list-group-item">
    <img class="mr-3" src="{{ $user->gravatar() }}" alt="{{ $user->name }}" width=32>
    <a href="{{ route('users.show', $user) }}">
        {{ $user->name }}

        @can('destroy', $user)
        <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="float-right">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
        @endcan
    </a>
</div>
