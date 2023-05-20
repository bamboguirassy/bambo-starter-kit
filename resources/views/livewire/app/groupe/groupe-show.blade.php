@showable($modelName)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Groupe d'utilisateur - {{ $groupe->nom }}</h4>
                @listable($modelName)
                    <a name="" id="" class="btn btn-secondary" href="{{ route('app.groupe.index') }}"
                        role="button">Afficher la liste <i class="fas fa-list-alt fa-sm fa-fw"></i></a>
                @endlistable
                @editable($modelName)
                    <button wire:click="openEditModal" type="button" class="btn btn-warning ms-1">Modifier <i
                            class="fas fa-edit fa-sm fa-fw"></i></button>
                @endeditable
                @deletable($modelName)
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
                                <td>{{ $groupe->nom }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Code</td>
                                <td>{{ $groupe->code }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Description</td>
                                <td>{{ $groupe->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endshowable
