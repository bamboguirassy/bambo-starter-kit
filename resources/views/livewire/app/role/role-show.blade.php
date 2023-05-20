@showable('role')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dossier role - {{ $role->id }}</h4>
                @listable('role')
                <a name="" id="" class="btn btn-secondary" href="{{ route('app.role.index') }}" role="button">Afficher la liste <i class="fas fa-list-alt fa-sm fa-fw"></i></a>
                @endlistable
                @editable('role')
                <button wire:click="openEditModal" type="button" class="btn btn-warning ms-1">Modifier <i
                        class="fas fa-edit fa-sm fa-fw"></i></button>
                @endeditable
                @deletable('role')
                <button wire:click="tryDelete" type="button" class="btn btn-danger ms-1">Supprimer <i
                        class="fas fa-trash fa-sm fa-fw"></i></button>
                @enddeletable
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                Détails
            </div>
            <div class="card-body pt-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <tbody>
                            
<tr>
    <th scope="row">Nom</td>
    <td>{{ $role->nom }}</td>
</tr>
<tr>
    <th scope="row">Table_name</td>
    <td>{{ $role->table_name }}</td>
</tr>
<tr>
    <th scope="row">Ordre</td>
    <td>{{ $role->ordre }}</td>
</tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endshowable