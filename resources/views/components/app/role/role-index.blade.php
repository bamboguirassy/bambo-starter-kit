<section class="section">
    <div class="row">
        @creable('role')
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3 d-flex justify-content-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-{{ $primary_color }} btn-sm" data-bs-toggle="modal"
                            data-bs-target="#newRoleModal">
                            Nouveau <i class="fas fa-plus-circle fa-sm fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endcreable
        @listable('role')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des fonctionnalités à protéger</h4>
                        @livewire('app.role.role-list')
                    </div>
                </div>
            </div>
        </div>
    @endlistable
</section>

@creable('role')
    <!--new role Modal -->
    <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="roleModalTitleId">Nouvelle fonctionnalité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @livewire('app.role.role-new')
                </div>
            </div>
        </div>
    </div>
@endcreable

@editable('role')
    <!--edit role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="roleEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="roleEditModalTitleId">Modification fonctionnalité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @livewire('app.role.role-edit')
                </div>
            </div>
        </div>
    </div>
@endeditable

@push('scripts')
    <script>
        @creable('role')
        Livewire.on('closeRoleNewModal', () => {
            var newModalEl = document.getElementById('newRoleModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
        @endcreable
        @editable('role')
        Livewire.on('openRoleEditModal', (roleId) => {
            var myModal = new bootstrap.Modal(document.getElementById('editRoleModal'), {
                backdrop: false
            })
            myModal.show();
        })
        Livewire.on('closeRoleEditModal', () => {
            var newModalEl = document.getElementById('editRoleModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
        @endeditable
    </script>
@endpush
