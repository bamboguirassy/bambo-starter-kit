<?php

namespace App\Http\Livewire\App\Groupe;

use App\Models\Groupe;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;
use Livewire\WithPagination;

class GroupeList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginationLength = 15;
    public $filterText;
    public $modelName = 'groupe';

    public function updatedPaginationLength() {
        $this->resetPage();
    }

    public function updatedFilterText() {
        $this->resetPage();
    }

    public Groupe $selectedGroupe;

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeGroupeEditModal'=>'render',
        'closeGroupeNewModal'=>'render'
    ];

    public function render()
    {
        $groupeQuery = Groupe::orderBy('id','asc');
        if($this->filterText) {
            $groupeQuery->where('id','like',"%$this->filterText%")
            ->orWhere('nom', 'like', "%$this->filterText%")
            ->orWhere('code', 'like', "%$this->filterText%");
        }
        return view('livewire.app.groupe.groupe-list',['groupes'=>$groupeQuery->paginate($this->paginationLength)]);
    }

    public function openEditModal($groupeId) {
        $this->emit('openGroupeEditModal',$groupeId);
    }

    public function tryDelete(Groupe $groupe) {
        $this->selectedGroupe = $groupe;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedGroupe->deleteOrFail();
            Flasher::addSuccess("Groupe supprimé avec succès !");
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }
}
