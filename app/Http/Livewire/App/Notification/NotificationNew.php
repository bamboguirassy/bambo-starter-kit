<?php

namespace App\Http\Livewire\App\Notification;

use App\Models\Notification;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class NotificationNew extends Component
{
    public Notification $notification;

    protected $rules = [
        
'notification.type'=>'required',
'notification.notifiable_type'=>'required',
'notification.notifiable_id'=>'required',
'notification.data'=>'required',
'notification.read_at'=>'required',
    ];

    public function boot() {
        $this->notification = new Notification();
    }

    public function updated($property) {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.app.notification.notification-new');
    }

    public function closeModal() {
        $this->emit('closeNotificationNewModal');
    }

    public function save() {
        $this->validate();
        try {
            $this->notification->save();
            $this->notification = new Notification();
            Flasher::addSuccess("Notification enregistré avec succès !");
            $this->closeModal();
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de l'enregistrement !");
        }
    }
}
