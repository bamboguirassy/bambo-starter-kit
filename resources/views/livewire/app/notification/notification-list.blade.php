@listable('notification')
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="mb-3">
                <label for="" class="form-label">Nombre d'éléments / page</label>
                <select wire:model="paginationLength" class="form-select form-select-sm" name="paginationLength"
                    id="paginationLength">
                    <option selected>15</option>
                    <option>30</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <hr class="py-1 bg-{{ $primary_color }}">
        </div>
        <div class="col-12 row">
            @foreach ($notifications as $index => $notification)
                <div class="col-12">
                    <div class="card @if (!$notification->read_at) bg-warning text-white @endif">
                        <div class="card-body">
                            <a href="{{ route('app.notification.show', compact('notification')) }}">
                                <h6 class="card-title mb-0">{{ $notification->data['notification_title'] ?? 'Sans titre' }}
                                    </h4>
                                    <hr class="py-1 my-0">
                                    <p class="card-text">{{ $notification->data['notification_text'] ?? 'Sans contenu' }}
                                    </p>
                                    <span class="badge bg-{{ $primary_color }} mx-1">
                                        Reçue le {{ date_format(new DateTime($notification->created_at), 'd/m/Y') }}
                                    </span>
                                    @if ($notification->read_at)
                                        <span class="badge bg-secondary mx-1">
                                            Lue le {{ date_format(new DateTime($notification->read_at), 'd/m/Y') }}
                                        </span>
                                    @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endlistable
