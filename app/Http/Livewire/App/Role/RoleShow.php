<?php

namespace App\Http\Livewire\App\Role;

use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class RoleShow extends Component
{
    public Role $role;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeRoleEditModal'=>'render'
    ];
    
    public function render()
    {
        return view('livewire.app.role.role-show');
    }

    public function tryDelete(Role $role) {
        $this->selectedRole = $role;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedRole->deleteOrFail();
            Flasher::addSuccess("Role supprimé avec succès !");
            return redirect()->route('app.role.index');
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }

    public function openEditModal() {
        $this->emit('openRoleEditModal',$this->role->id);
    }
}
