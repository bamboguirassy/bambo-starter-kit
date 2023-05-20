<section>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title pb-0 d-flex justify-content-between">
                <span style="font-size: 25px;">Gestion des droits d'accès</span>
                <button wire:click="save" type="button" class="btn btn-{{ $primary_color }}">Enregistrer</button>
            </h4>
            <hr class="py-1 bg-secondary">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div class="form-check">
                                    <input wire:model="checkAll" class="form-check-input" name="checkAll" id="checkAll"
                                        type="checkbox" aria-label="Tout cocher">
                                </div>
                            </th>
                            <th scope="col">Ressource</th>
                            <th scope="col"><i class="fas fa-list fa-sm fa-fw"></i></th>
                            <th scope="col"><i class="fas fa-plus fa-sm fa-fw"></i></th>
                            <th scope="col"><i class="fas fa-edit fa-sm fa-fw"></i></th>
                            <th scope="col"><i class="fas fa-eye fa-sm fa-fw"></i></th>
                            <th scope="col"><i class="fas fa-trash fa-sm fa-fw"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roleData as $ressource => $roleItems)
                            <tr class="">
                                <td scope="row">
                                    <div class="form-check">
                                        <input
                                            onchange="@this.checkRessource('{{ $ressource }}',event.target.checked)"
                                            class="form-check-input" name="cocher-{{ $ressource }}"
                                            id="cocher-{{ $ressource }}" type="checkbox"
                                            aria-label="{{ $ressource }} à cocher">
                                    </div>
                                </td>
                                <td scope="row">{{ Str::ucfirst($ressource) }}</td>
                                @foreach ($roleItems as $roleItem)
                                    <td>
                                        <div class="form-check">
                                            <input wire:model="groupeRoles.{{ $roleItem['id'] }}.enabled"
                                                class="form-check-input" name="role-{{ $roleItem['id'] }}"
                                                id="role-{{ $roleItem['id'] }}" type="checkbox"
                                                aria-label="{{ $roleItem['id'] }}">
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <button wire:click="save" type="button" class="btn btn-{{ $primary_color }}">Enregistrer</button>
            </div>
        </div>
    </div>
</section>
