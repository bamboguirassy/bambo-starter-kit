<section class="section">
    <div class="row">
        @creable('user')
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3 d-flex justify-content-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-{{ $primary_color }} btn-sm" data-bs-toggle="modal"
                            data-bs-target="#newUserModal">
                            Nouvel administrateur <i class="fas fa-plus-circle fa-sm fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endcreable
        @listable('user')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des utilisateurs</h4>
                        @livewire('app.user.user-list')
                    </div>
                </div>
            </div>
        </div>
    @endlistable
</section>

@creable('user')
    <!--new user Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="userModalTitleId">Nouvel administrateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @livewire('app.user.user-new')
                </div>
            </div>
        </div>
    </div>
@endcreable

@editable('user')
    <!--edit user Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="userEditModalTitleId">Modification utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @livewire('app.user.user-edit')
                </div>
            </div>
        </div>
    </div>
@endeditable

@push('scripts')
    <script>
        @creable('user')
        Livewire.on('closeUserNewModal', () => {
            var newModalEl = document.getElementById('newUserModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
        @endcreable
        @editable('user')
        Livewire.on('openUserEditModal', (userId) => {
            var myModal = new bootstrap.Modal(document.getElementById('editUserModal'), {
                backdrop: false
            })
            myModal.show();
        })
        Livewire.on('closeUserEditModal', () => {
            var newModalEl = document.getElementById('editUserModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
        @endeditable
    </script>
@endpush
