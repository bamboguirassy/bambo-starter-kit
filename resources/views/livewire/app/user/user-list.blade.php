@listable('user')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center pb-0">Filtrer les utilisateurs</h4>
                    <hr class="py-1 bg-secondary">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-2">
                            <label for="selectedStatut" class="form-label">Status</label>
                            <div class="form-check form-switch form-check-lg">
                                <input wire:model.lazy="selectedStatut" class="form-check-input bg-{{ $primary_color }}" type="checkbox"
                                    id="selectedStatut">
                                <label class="form-check-label" for="selectedStatut">Actif</label>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-md-3 ">
                            <label for="selectedRoleId" class="form-label">Role</label>
                            <select wire:model="selectedRoleId" class="form-select " name="selectedRoleId"
                                id="selectedRoleId">
                                <option value="">Selectionner un role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between">
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
            <div class="">
                <div class="input-group">
                    <span class="input-group-text" id="searchGroup">
                        <i class="fas fa-search fa-sm fa-fw"></i>
                    </span>
                    <input wire:model="filterText" type="text" name="filterInput" id="filterInput" class="form-control"
                        placeholder="Rechercher" aria-describedby="searchGroup">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Enabled</th>
                            <th class="col fixed-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if ($user->enabled)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td class="col fixed-col">
                                    @showable('user')
                                    <a class="btn btn-sm btn-{{ $primary_color }} mx-1"
                                        href="{{ route('app.user.show', compact('user')) }}">
                                        <i class="fas fa-eye fa-sm fa-fw"></i>
                                    </a>
                                    @endshowable
                                    @editable('user')
                                        <button wire:click.prevent="openEditModal({{ $user->id }})" type="button"
                                            class="btn btn-warning btn-sm mx-1">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </button>
                                    @endeditable
                                    @deletable('user')
                                        <button wire:click.prevent="tryDelete({{ $user->id }})" type="button"
                                            class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash fa-sm fa-fw"></i>
                                        </button>
                                    @enddeletable
                                    @if (auth()->user()->is_admin)
                                        <button wire:click="loginAs({{$user->id}})" type="button" class="btn btn-{{ $primary_color }} btn-sm">Se connecter en tant
                                            que <i class="fas fa-chevron-up fa-sm fa-fw"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endlistable
