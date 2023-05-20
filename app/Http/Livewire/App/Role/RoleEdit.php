<?php

namespace App\Http\Livewire\App\Role;

use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class RoleEdit extends Component
{
    protected $listeners = ['openRoleEditModal' => 'loadRole'];

    public Role $role;

    protected $rules = [
        'role.nom' => 'required',
        'role.table_name' => 'required',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function boot()
    {
        $this->role = new Role();
    }

    public function render()
    {
        return view('livewire.app.role.role-edit');
    }

    public function closeModal()
    {
        $this->emit('closeRoleEditModal');
    }

    public function loadRole(Role $role)
    {
        $this->role = $role;
    }

    public function update()
    {
        $this->validate();
        try {
            $this->role->updateOrFail();
            Flasher::addSuccess("Role mis à jour avec succès !");
            $this->closeModal();
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de la mise à jour !");
        }
    }
}
