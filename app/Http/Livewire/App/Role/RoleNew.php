<?php

namespace App\Http\Livewire\App\Role;

use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class RoleNew extends Component
{
    public Role $role;

    protected $rules = [
        'role.nom' => 'required|unique:roles,nom',
        'role.table_name' => 'required|unique:roles,table_name',
    ];

    public function boot()
    {
        $this->role = new Role();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.app.role.role-new');
    }

    public function closeModal()
    {
        $this->emit('closeRoleNewModal');
    }

    public function save()
    {
        $this->validate();
        try {
            $this->role->ordre=1;
            $this->role->fonctionnalite = true;
            $this->role->save();
            $this->role = new Role();
            Flasher::addSuccess("Fonctionnalitée enregistrée avec succès !");
            $this->closeModal();
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de l'enregistrement !");
        }
    }
}
