@extends('layouts.app')

@section('title',$pageTitle)

@section('content')
    <section class="section">
        @livewire('app.notification.notification-show',compact('notification'))
    </section>
    @editable('notification')
    <!--edit notification Modal -->
    <div class="modal fade" id="editNotificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationEditModalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ $primary_color }}">
                    <h5 class="modal-title text-white" id="notificationEditModalTitleId">Modification notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @livewire('app.notification.notification-edit')
                </div>
            </div>
        </div>
    </div>
    @endeditable
    @push('scripts')
        <script>
        @editable('notification')
            Livewire.on('openNotificationEditModal', (notificationId) => {
                var myModal = new bootstrap.Modal(document.getElementById('editNotificationModal'), {
                    backdrop: false
                })
                myModal.show();
            })
            Livewire.on('closeNotificationEditModal', () => {
                var newModalEl = document.getElementById('editNotificationModal')
                var modal = bootstrap.Modal.getInstance(newModalEl);
                modal.hide();
            })
        @endeditable
        </script>
    @endpush
@endsection
