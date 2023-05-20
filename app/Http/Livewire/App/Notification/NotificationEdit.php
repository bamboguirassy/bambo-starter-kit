<?php

namespace App\Http\Livewire\App\Notification;

use App\Models\Notification;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class NotificationEdit extends Component
{
    protected $listeners = ['openNotificationEditModal'=>'loadNotification'];
    
    public Notification $notification;

    protected $rules = [
        
'notification.type'=>'required',
'notification.notifiable_type'=>'required',
'notification.notifiable_id'=>'required',
'notification.data'=>'required',
'notification.read_at'=>'required',
    ];

    public function updated($property) {
        $this->validateOnly($property);
    }

    public function boot() {
        $this->notification = new Notification();
    }
    
    public function render()
    {
        return view('livewire.app.notification.notification-edit');
    }

    public function closeModal() {
        $this->emit('closeNotificationEditModal');
    }

    public function loadNotification(Notification $notification) {
        $this->notification = $notification;
    }

    public function update() {
        $this->validate();
        try {
            $this->notification->updateOrFail();
            Flasher::addSuccess("Notification mis à jour avec succès !");
            $this->closeModal();
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de la mise à jour !");
        }
    }
}
