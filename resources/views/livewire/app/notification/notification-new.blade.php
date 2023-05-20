<form method="post" wire:submit.prevent="save">
    <div class="row">
        <div class="col-12">
            @if ($errors->all())
                <ul class="h6">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger font-bold">{{$error}}</li>
                    @endforeach
                </ul>
                <hr>
            @endif
        </div>
        
<div class="col-12 col-md-6">
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input wire:model.lazy="notification.type" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('notification.type') is-invalid @elseif($notification->type!=null) is-valid @enderror" name="type"
                    id="type" placeholder="Type">
        @error('notification.type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="mb-3">
        <label for="notifiable_type" class="form-label">Notifiable_type</label>
        <input wire:model.lazy="notification.notifiable_type" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('notification.notifiable_type') is-invalid @elseif($notification->notifiable_type!=null) is-valid @enderror" name="notifiable_type"
                    id="notifiable_type" placeholder="Notifiable_type">
        @error('notification.notifiable_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="mb-3">
        <label for="notifiable_id" class="form-label">Notifiable_id</label>
        <input wire:model.lazy="notification.notifiable_id" wire:dirty.class.remove="is-valid" type="number"
                    class="form-control @error('notification.notifiable_id') is-invalid @elseif($notification->notifiable_id!=null) is-valid @enderror" name="notifiable_id"
                    id="notifiable_id" placeholder="Notifiable_id">
        @error('notification.notifiable_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input wire:model.lazy="notification.data" wire:dirty.class.remove="is-valid" type="text"
                    class="form-control @error('notification.data') is-invalid @elseif($notification->data!=null) is-valid @enderror" name="data"
                    id="data" placeholder="Data">
        @error('notification.data')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="mb-3">
        <label for="read_at" class="form-label">Read_at</label>
        <input wire:model.lazy="notification.read_at" wire:dirty.class.remove="is-valid" type="datetime-local"
                    class="form-control @error('notification.read_at') is-invalid @elseif($notification->read_at!=null) is-valid @enderror" name="read_at"
                    id="read_at" placeholder="Read_at">
        @error('notification.read_at')
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
