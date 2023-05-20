<?php

namespace App\Http\Livewire\App\Notification;

use App\Models\Notification;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class NotificationShow extends Component
{
    public Notification $notification;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeNotificationEditModal'=>'render'
    ];
    
    public function render()
    {
        return view('livewire.app.notification.notification-show');
    }

    public function tryDelete(Notification $notification) {
        $this->selectedNotification = $notification;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedNotification->deleteOrFail();
            Flasher::addSuccess("Notification supprimé avec succès !");
            return redirect()->route('app.notification.index');
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }

    public function openEditModal() {
        $this->emit('openNotificationEditModal',$this->notification->id);
    }
}
