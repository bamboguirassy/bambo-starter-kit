<?php

namespace App\Http\Livewire\App\Groupe;

use App\Models\Groupe;
use Flasher\Laravel\Facade\Flasher;
use Livewire\Component;

class GroupeEdit extends Component
{
    protected $listeners = ['openGroupeEditModal' => 'loadGroupe'];

    public Groupe $groupe;
    public $modelName = 'groupe';

    protected $rules = [
        'groupe.nom' => 'required',
        'groupe.code' => 'required',
        'groupe.description' => 'nullable',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function boot()
    {
        $this->groupe = new Groupe();
    }

    public function render()
    {
        return view('livewire.app.groupe.groupe-edit');
    }

    public function closeModal()
    {
        $this->emit('closeGroupeEditModal');
    }

    public function loadGroupe(Groupe $groupe)
    {
        $this->groupe = $groupe;
    }

    public function update()
    {
        $this->validate();
        try {
            $this->groupe->updateOrFail();
            Flasher::addSuccess("Groupe mis à jour avec succès !");
            $this->closeModal();
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de la mise à jour !");
        }
    }
}
