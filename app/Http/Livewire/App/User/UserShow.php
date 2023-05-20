<?php

namespace App\Http\Livewire\App\User;

use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class UserShow extends Component
{
    public User $user;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeUserEditModal'=>'render'
    ];
    
    public function render()
    {
        return view('livewire.app.user.user-show');
    }

    public function tryDelete(User $user) {
        $this->selectedUser = $user;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedUser->deleteOrFail();
            Flasher::addSuccess("User supprimé avec succès !");
            return redirect()->route('app.user.index');
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }

    public function openEditModal() {
        $this->emit('openUserEditModal',$this->user->id);
    }
}
