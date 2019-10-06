@can('friend', $user)
<div class="text-center mt-2 mb-4">
    @if (Auth::user()->isFriend($user->id))
    <form action="{{ route('users.unfriend', $user->id) }}" method="post">
        @csrf
        {{ method_field('POST') }}
        <button type="submit" class="btn btn-sm btn-outline-primary">取消关注</button>
    </form>
    @else
    <form action="{{ route('users.friend', $user->id) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-sm btn-primary">关注</button>
    </form>
</div>
@endif
@endcan
