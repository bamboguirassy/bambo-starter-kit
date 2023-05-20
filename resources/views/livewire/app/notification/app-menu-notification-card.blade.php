<div>
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span wire:poll.10000ms class="badge bg-{{ $primary_color }} badge-number">{{ $notifications->count() }}</span>
    </a><!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" wire:poll.10000ms>
        <li class="dropdown-header">
            {{ $notifications->count() }} nouvelle(s) notification(s)
            <a href="{{ route('app.notification.index') }}"><span class="badge rounded-pill bg-{{ $primary_color }} p-2 ms-2">Afficher
                    tout</span></a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        @foreach ($notifications as $notification)
            <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                    <a href="{{ route('app.notification.show', compact('notification')) }}">
                        <h4>{{ $notification->data['notification_title'] ?? 'Sans titre' }}</h4>
                        <p>{{ $notification->data['notification_text'] ?? 'Sans contenu' }}</p>
                        <p>30 min. ago</p>
                    </a>
                </div>
            </li>
        @endforeach

        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
            <a href="{{ route('app.notification.index') }}">Voir toutes les notifications</a>
        </li>

    </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->
    </>
