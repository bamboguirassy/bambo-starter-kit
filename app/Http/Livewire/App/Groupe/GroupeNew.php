<?php

namespace App\Http\Livewire\App\Groupe;

use App\Models\Groupe;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GroupeNew extends Component
{
    public Groupe $groupe;
    public $modelName = 'groupe';

    protected $rules = [
        'groupe.nom' => 'required|unique:groupes,nom',
        'groupe.code' => 'required|unique:groupes,code',
        'groupe.description' => 'nullable',
    ];

    public function boot()
    {
        $this->groupe = new Groupe();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.app.groupe.groupe-new');
    }

    public function closeModal()
    {
        $this->emit('closeGroupeNewModal');
    }

    public function save()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->groupe->save();
            $this->groupe = new Groupe();
            Flasher::addSuccess("Groupe enregistré avec succès !");
            $this->closeModal();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de l'enregistrement !");
        }
    }
}
