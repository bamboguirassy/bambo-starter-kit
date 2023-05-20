@extends('layouts.app')

@section('title',$pageTitle)

@section('content')
    <section class="section">
        @livewire('app.role.role-show',compact('role'))
    </section>
    @editable('role')
    <!--edit role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="roleEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="roleEditModalTitleId">Modification role</h5>
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
@endsection
