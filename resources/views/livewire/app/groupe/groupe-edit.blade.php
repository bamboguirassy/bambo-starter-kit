@editable($modelName)
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
                    <label for="nom" class="form-label">Nom</label>
                    <input wire:model.lazy="groupe.nom" wire:dirty.class.remove="is-valid" type="text"
                        class="form-control @error('groupe.nom') is-invalid @elseif($groupe->nom != null) is-valid @enderror"
                        name="nom" id="nom" placeholder="Nom">
                    @error('groupe.nom')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input wire:model.lazy="groupe.code" wire:dirty.class.remove="is-valid" type="text"
                        class="form-control @error('groupe.code') is-invalid @elseif($groupe->code != null) is-valid @enderror"
                        name="code" id="code" placeholder="Code">
                    @error('groupe.code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea wire:model.lazy="groupe.description" wire:dirty.class.remove="is-valid" type="text"
                        class="form-control @error('groupe.description') is-invalid @elseif($groupe->description != null) is-valid @enderror"
                        name="description" id="description" placeholder="Description"></textarea>
                    @error('groupe.description')
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
@endeditable
