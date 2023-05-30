<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{$newCount}}</span>
    </a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header">{{$newCount}} Notifications</span>
    <div class="dropdown-divider"></div>
    @foreach($notifications as $notification)
    <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
       class="dropdown-item text-wrap
       @if ($notification->unread()) text-bold @endif">
        <i class="{{ $notification->data['icon'] }} mr-2"></i>
        {{ Str::limit($notification->data['body'] , 14, $end='...')  }}
        <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
    </a>
    <div class="dropdown-divider"></div>
    @endforeach
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
</li>
