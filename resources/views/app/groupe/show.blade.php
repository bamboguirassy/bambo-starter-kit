@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <section class="section">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="groupeShowTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button"
                    role="tab" aria-controls="details" aria-selected="true">Détails</button>
            </li>
            @listable('grouperole')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button"
                        role="tab" aria-controls="roles" aria-selected="false">Roles</button>
                </li>
            @endlistable
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button"
                    role="tab" aria-controls="messages" aria-selected="false">Autres</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="details" role="tabpanel" aria-labelledby="details-tab">
                @livewire('app.groupe.groupe-show', compact('groupe'))
            </div>
            @editable('grouperole')
                <div class="tab-pane" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                    @livewire('app.groupe.groupe-role-management', compact('groupe'))
                </div>
            @endeditable
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab"> messages </div>
        </div>
    </section>

    <!--edit groupe Modal -->
    <div class="modal fade" id="editGroupeModal" tabindex="-1" role="dialog" aria-labelledby="groupeEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
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
@endsection
