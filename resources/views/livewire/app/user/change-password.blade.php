<form method="POST" wire:submit.prevent="updatePassword">
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
        <div class="row mb-3">
            <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
            <div class="col-md-8 col-lg-9">
                <input name="current_password" type="password" autocomplete="off"
                    class="form-control  @error('current_password') is-invalid @elseif($current_password != null) is-valid @enderror"
                    id="current_password" wire:model.lazy="current_password">
                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
            <div class="col-md-8 col-lg-9">
                <input name="password" type="password"
                    class="form-control  @error('password') is-invalid @elseif($password != null) is-valid @enderror"
                    id="password" wire:model.lazy="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>

        <div class="row mb-3">
            <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Confirmation nouveau mot de
                passe</label>
            <div class="col-md-8 col-lg-9">
                <input name="password_confirmation" type="password"
                    class="form-control  @error('password_confirmation') is-invalid @elseif($password_confirmation != null and $password_confirmation == $password) is-valid @enderror"
                    id="password_confirmation" wire:model.lazy="password_confirmation">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-{{ $primary_color }}">Changer mot de passe</button>
        </div>
</form>
