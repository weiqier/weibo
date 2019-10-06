<a href="{{ route('users.followers',$user->id) }}">
    <strong id="following" class="stat">
        {{ count($user->fans) }}
    </strong>
    关注
</a>
<a href="{{ route('users.fans',$user->id) }}">
    <strong id="followers" class="stat">
        {{ count($user->followers) }}
    </strong>
    粉丝
</a>
<a href="#">
    <strong id="statuses" class="stat">
        {{ $user->statuses()->count() }}
    </strong>
    微博
</a>
