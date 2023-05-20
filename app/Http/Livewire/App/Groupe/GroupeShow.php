<?php

namespace App\Http\Livewire\App\Groupe;

use App\Models\Groupe;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class GroupeShow extends Component
{
    public Groupe $groupe;
    public $modelName = 'groupe';

    protected $listeners = [
        'sweetalertConfirmed'=>'confirmDelete',
        'closeGroupeEditModal'=>'render'
    ];
    
    public function render()
    {
        return view('livewire.app.groupe.groupe-show');
    }

    public function tryDelete(Groupe $groupe) {
        $this->selectedGroupe = $groupe;
        sweetalert()->showDenyButton()->addInfo("Êtes-vous sûr de vouloir supprimer cet élément ?");
    }

    public function confirmDelete() {
        try {
            $this->selectedGroupe->deleteOrFail();
            Flasher::addSuccess("Groupe supprimé avec succès !");
            return redirect()->route('app.groupe.index');
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur survenue lors de la suppression !");
        }
    }

    public function openEditModal() {
        $this->emit('openGroupeEditModal',$this->groupe->id);
    }
}
