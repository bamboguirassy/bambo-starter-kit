<section class="section">
    <div class="row">
    @creable('notification')
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-body py-3 d-flex justify-content-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-{{ $primary_color }} btn-sm" data-bs-toggle="modal"
                        data-bs-target="#newNotificationModal">
                        Nouveau <i class="fas fa-plus-circle fa-sm fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}
    @endcreable
    @listable('notification')
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Liste des notifications</h4>
                    @livewire('app.notification.notification-list')
                </div>
            </div>
        </div>
    </div>
    @endlistable
</section>

@creable('notification')
<!--new notification Modal -->
<div class="modal fade" id="newNotificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-{{ $primary_color }}">
                <h5 class="modal-title text-white" id="notificationModalTitleId">Nouveau notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @livewire('app.notification.notification-new')
            </div>
        </div>
    </div>
</div>
@endcreable

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
    @creable('notification')
        Livewire.on('closeNotificationNewModal', () => {
            var newModalEl = document.getElementById('newNotificationModal')
            var modal = bootstrap.Modal.getInstance(newModalEl);
            modal.hide();
        })
    @endcreable
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