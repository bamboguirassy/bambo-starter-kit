@php
    $modelName = 'groupe';
@endphp
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-3 d-flex justify-content-center">
                    <!-- Button trigger modal -->
                    @creable($modelName)
                        <button type="button" class="btn btn-{{ $primary_color }} btn-sm" data-bs-toggle="modal"
                            data-bs-target="#newGroupeModal">
                            Nouveau <i class="fas fa-plus-circle fa-sm fa-fw"></i>
                        </button>
                    @endcreable
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des groupes d'utilisateurs</h4>
                    @livewire('app.groupe.groupe-list')
                </div>
            </div>
        </div>
    </div>
</section>

<!--new groupe Modal -->
<div class="modal fade" id="newGroupeModal" tabindex="-1" role="dialog" aria-labelledby="groupeModalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-{{ $primary_color }}">
                <h5 class="modal-title text-white" id="groupeModalTitleId">Nouveau groupe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @livewire('app.groupe.groupe-new')
            </div>
        </div>
    </div>
</div>
<!--edit groupe Modal -->
<div class="modal fade" id="editGroupeModal" tabindex="-1" role="dialog" aria-labelledby="groupeEditModalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-{{ $primary_color }}">
                <h5 class="modal-title text-white" id="groupeEditModalTitleId">Modification groupe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @livewire('app.groupe.groupe-edit')
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('closeGroupeNewModal', () => {
            var newModalEl = document.getElementById('newGroupeModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
        Livewire.on('openGroupeEditModal', (groupeId) => {
            var myModal = new bootstrap.Modal(document.getElementById('editGroupeModal'), {
                backdrop: false
            })
            myModal.show();
        })
        Livewire.on('closeGroupeEditModal', () => {
            var newModalEl = document.getElementById('editGroupeModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
    </script>
@endpush
