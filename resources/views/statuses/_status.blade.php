<li class="media mt-2">
    <div class="media-body breadcrumb">
        <h5 class="mt-0 mb-1">{{ $user->name }} <small> <span
                    class="badge badge-secondary">{{ $status->created_at->diffForHumans() }}</span></small></h5>
        {{ $status->content }}
    </div>
</li>
