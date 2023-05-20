<?php

namespace App\Http\Livewire\App\Notification;

use App\Models\Notification;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginationLength = 15;

    public function updatedPaginationLength() {
        $this->resetPage();
    }

    public function updatedFilterText() {
        $this->resetPage();
    }

    public Notification $selectedNotification;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
    ];

    public function render()
    {
        $notificationQuery = Auth::user()->notifications()->orderBy('created_at','desc')->orderBy('read_at','asc');
        return view('livewire.app.notification.notification-list',['notifications'=>$notificationQuery->paginate($this->paginationLength)]);
    }

    public function confirmDelete() {
        try {
            $this->selectedNotification->deleteOrFail();
            Flasher::addSuccess("Notification supprimé avec succès !");
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }
}
