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
                <label for="name" class="form-label">Nom complet</label>
                <input wire:model.lazy="user.name" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('user.name') is-invalid @elseif($user->name != null) is-valid @enderror"
                    name="name" id="name" placeholder="Nom complet">
                @error('user.name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input wire:model.lazy="user.email" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('user.email') is-invalid @elseif($user->email != null) is-valid @enderror"
                    name="email" id="email" placeholder="Email">
                @error('user.email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @if ($user && !$user->is_employe)
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="enabled" class="form-label">Etat compte</label>
                <div class="form-check form-switch">
                    <input wire:model.lazy="user.enabled" wire:dirty.class.remove="is-valid"
                        class="form-check-input @error('user.enabled') is-invalid @elseif($user->enabled != null) is-valid @enderror"
                        type="checkbox" id="enabled">
                    <label class="form-check-label" for="enabled"></label>
                </div>
                @error('user.enabled')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @endif
        @if ($user && !$user->is_employe)
            <div class="col-12">
                <p class="lead">
                    Merci de préciser les accès de cet utilisateur...
                </p>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach ($groupes as $groupe)
                        <div class="col-12 col-md-6">
                            <div class="form-check form-check-inline">
                                <input wire:model="groupeIds"
                                    class="form-check-input @error('groupeIds') is-invalid @elseif(count($groupeIds)) is-valid @enderror"
                                    wire:dirty.class.remove="is-valid" type="checkbox" id="groupe-{{ $groupe->id }}"
                                    value="{{ $groupe->id }}">
                                <label class="form-check-label"
                                    for="groupe-{{ $groupe->id }}">{{ $groupe->nom }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('groupeIds')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        <div class="col-12">
            <div class="modal-footer d-flex justify-content-between">
                <button wire:click="closeModal" type="button" class="btn btn-lg btn-secondary">Annuler</button>
                <button type="submit" class="btn btn-lg btn-{{ $primary_color }}">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
