@showable('notification')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dossier notification - {{ $notification->id }}</h4>
                @listable('notification')
                <a name="" id="" class="btn btn-secondary" href="{{ route('app.notification.index') }}" role="button">Afficher la liste <i class="fas fa-list-alt fa-sm fa-fw"></i></a>
                @endlistable
                @editable('notification')
                <button wire:click="openEditModal" type="button" class="btn btn-warning ms-1">Modifier <i
                        class="fas fa-edit fa-sm fa-fw"></i></button>
                @endeditable
                @deletable('notification')
                <button wire:click="tryDelete" type="button" class="btn btn-danger ms-1">Supprimer <i
                        class="fas fa-trash fa-sm fa-fw"></i></button>
                @enddeletable
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body pt-2">
                <div class="card-title pb-0">
                    Détails
                </div>
                <hr class="py-1 bg-secondary">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <tbody>
                            
<tr>
    <th scope="row">Type</td>
    <td>{{ $notification->type }}</td>
</tr>
<tr>
    <th scope="row">Notifiable_type</td>
    <td>{{ $notification->notifiable_type }}</td>
</tr>
<tr>
    <th scope="row">Notifiable_id</td>
    <td>{{ $notification->notifiable_id }}</td>
</tr>
<tr>
    <th scope="row">Data</td>
    <td>{{ $notification->data }}</td>
</tr>
<tr>
    <th scope="row">Read_at</td>
    <td>{{ $notification->read_at }}</td>
</tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endshowable