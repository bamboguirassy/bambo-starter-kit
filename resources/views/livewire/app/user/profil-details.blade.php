<div>
    <h5 class="card-title">Les détails de mon profil</h5>

    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Nom complet</div>
        <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Email</div>
        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Role</div>
        <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Groupes d'utilisateur</div>
        <div class="col-lg-9 col-md-8">
            <ul class="list-group">
                @foreach ($user->groupes as $groupe)
                    <li class="list-group-item">{{ $groupe->nom }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
