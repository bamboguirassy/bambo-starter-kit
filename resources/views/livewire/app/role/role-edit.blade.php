<form method="post" wire:submit.prevent="update">
    <div class="row">
        <div class="col-12">
            @if ($errors->all())
                <ul class="h6">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger font-bold">{{ $error }}</li>
                    @endforeach
                </ul>
                <hr>
            @endif
        </div>
        <div class="col-12 col-md-12">
            <div class="mb-3">
                <label for="table_name" class="form-label">Nom fonctionnalité</label>
                <input wire:model.lazy="role.table_name" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('role.table_name') is-invalid @elseif($role->table_name != null) is-valid @enderror"
                    name="table_name" id="table_name" placeholder="Table_name">
                @error('role.table_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="mb-3">
                <label for="nom" class="form-label">Clé de vérification</label>
                <input wire:model.lazy="role.nom" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('role.nom') is-invalid @elseif($role->nom != null) is-valid @enderror"
                    name="nom" id="nom" placeholder="Nom">
                @error('role.nom')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="modal-footer d-flex justify-content-between">
                <button wire:click="closeModal" type="button" class="btn btn-lg btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-lg btn-{{ $primary_color }}">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
