@extends('layouts.app')

@section('title',$pageTitle)

@section('content')
    <section class="section">
        @livewire('app.user.user-show',compact('user'))
    </section>
    @editable('user')
    <!--edit user Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="userEditModalTitleId">Modification user</h5>
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
@endsection
