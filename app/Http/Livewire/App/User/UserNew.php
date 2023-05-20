<?php

namespace App\Http\Livewire\App\User;

use App\Models\Groupe;
use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserNew extends Component
{
    public User $user;
    public $groupes;
    public $groupeIds = [];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'email|unique:users,email',
        'groupeIds'=>'array|required'
    ];

    public function boot()
    {
        $this->user = new User();
        $this->groupes = Groupe::where('code','!=','EMPLOYE')->get();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.app.user.user-new');
    }

    public function closeModal()
    {
        $this->emit('closeUserNewModal');
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->user->password = Hash::make('passer123');
            $this->user->enabled = true;
            $this->user->role = 'default';
            $this->user->saveOrFail();
            $this->user->groupes()->sync($this->groupeIds);
            DB::commit();
            $this->closeModal();
            Flasher::addSuccess("Administrateur ajouté avec succès !");
            $this->user = new User();
            $this->groupeIds = [];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de l'enregistrement !");
        }
    }
}
