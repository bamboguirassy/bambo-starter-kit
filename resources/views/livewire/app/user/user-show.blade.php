@showable('user')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Compte utilisateur - {{ $user->name }}</h4>
                @listable('user')
                    <a name="" id="" class="btn btn-secondary" href="{{ route('app.user.index') }}"
                        role="button">Afficher la liste <i class="fas fa-list-alt fa-sm fa-fw"></i></a>
                @endlistable
                @editable('user')
                    <button wire:click="openEditModal" type="button" class="btn btn-warning ms-1">Modifier <i
                            class="fas fa-edit fa-sm fa-fw"></i></button>
                @endeditable
                @deletable('user')
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
                                <th scope="row">Nom complet</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Role</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Statut</td>
                                <td>
                                    @if ($user->enabled)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-body pt-2">
                <div class="card-title pb-0">
                    Roles de l'utilisateur
                </div>
                <hr class="py-1 bg-secondary">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <tbody>
                            @foreach ($user->groupes as $groupe)
                                <tr>
                                    <td>{{ $groupe->nom }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endshowable
