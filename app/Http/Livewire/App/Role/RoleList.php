<?php

namespace App\Http\Livewire\App\Role;

use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginationLength = 15;
    public $filterText;

    public function updatedPaginationLength() {
        $this->resetPage();
    }

    public function updatedFilterText() {
        $this->resetPage();
    }

    public Role $selectedRole;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeRoleEditModal'=>'render',
        'closeRoleNewModal'=>'render'
    ];

    public function render()
    {
        $roleQuery = Role::whereFonctionnalite(true)->orderBy('nom','asc');
        if($this->filterText) {
            $roleQuery->where(function($q) {
                $q->where('nom','like',"%$this->filterText%")
            ->orwhere('table_name','like',"%$this->filterText%");
        });
        }
        return view('livewire.app.role.role-list',['roles'=>$roleQuery->paginate($this->paginationLength)]);
    }

    public function openEditModal($roleId) {
        $this->emit('openRoleEditModal',$roleId);
    }

    public function tryDelete(Role $role) {
        $this->selectedRole = $role;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedRole->deleteOrFail();
            Flasher::addSuccess("Role supprimé avec succès !");
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }
}
