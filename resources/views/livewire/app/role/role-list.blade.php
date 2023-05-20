@listable('role')
    <div class="row">
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
                            <th scope="col">Nom fonctionnalité</th>
                            <th scope="col">Clé de vérification</th>
                            <th class="col fixed-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $role->table_name }}</td>
                                <td>{{ $role->nom }}</td>
                                <td class="col fixed-col">
                                    @editable('role')
                                        <button wire:click.prevent="openEditModal({{ $role->id }})" type="button"
                                            class="btn btn-warning btn-sm mx-1">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </button>
                                    @endeditable
                                    @deletable('role')
                                        <button wire:click.prevent="tryDelete({{ $role->id }})" type="button"
                                            class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash fa-sm fa-fw"></i>
                                        </button>
                                    @enddeletable
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endlistable
