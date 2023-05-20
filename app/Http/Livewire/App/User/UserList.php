<?php

namespace App\Http\Livewire\App\User;

use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Groupe;
use Illuminate\Support\Facades\Auth;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginationLength = 15;
    public $filterText;
    public $selectedStatut = true;
    public $selectedRoleId;
    public $roles = [];

    protected $rules = [
        'selectedStatut' => 'nullable',
        'selectedRoleId' => 'nullable',
    ];

    public function updatedPaginationLength()
    {
        $this->resetPage();
    }

    public function updatedFilterText()
    {
        $this->resetPage();
    }

    public User $selectedUser;

    protected $listeners = [
        'sweetalertConfirmed' => 'confirmDelete',
        'closeUserEditModal' => 'render',
        'closeUserNewModal' => 'render'
    ];

    public function boot()
    {
        $this->roles = Groupe::all();
    }
    public function render()
    {
        $userQuery = User::orderBy('id', 'asc');
        if ($this->filterText) {
            $userQuery = $userQuery->where(function ($q) {
                $q->orwhere('name', 'like', "%$this->filterText%")
                    ->orWhere('email', 'like', "%$this->filterText%");
            });
        }
        if ($this->selectedStatut) {
            $userQuery = $userQuery->where('enabled', $this->selectedStatut);
        } else {
            $userQuery = $userQuery->where('enabled', $this->selectedStatut);
        }
        if ($this->selectedRoleId) {
            $userQuery = $userQuery->whereHas('userGroupes', function ($q) {
                $q->whereRelation('groupe', 'id', $this->selectedRoleId);
            });
        }
        return view('livewire.app.user.user-list', ['users' => $userQuery->paginate($this->paginationLength)]);
    }

    public function openEditModal($userId)
    {
        $this->emit('openUserEditModal', $userId);
    }

    public function tryDelete(User $user)
    {
        $this->selectedUser = $user;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete()
    {
        try {
            $this->selectedUser->deleteOrFail();
            Flasher::addSuccess("User supprimé avec succès !");
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }

    public function loginAs(User $user) {
        Auth::login($user);
        return redirect()->route('app.home');
    }
}
