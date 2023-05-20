<?php

namespace App\Http\Livewire\App\User;

use App\Models\Groupe;
use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserEdit extends Component
{
    protected $listeners = ['openUserEditModal' => 'loadUser'];

    public User $user;
    public $groupes;
    public $groupeIds = [];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'email',
        'user.enabled'=>'nullable',
        'groupeIds'=>'array|required'
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function boot()
    {
        $this->user = new User();
        $this->groupes = Groupe::where('code','!=','EMPLOYE')->get();
    }

    public function render()
    {
        return view('livewire.app.user.user-edit');
    }

    public function closeModal()
    {
        $this->emit('closeUserEditModal');
    }

    public function loadUser(User $user)
    {
        $this->user = $user;
        $this->groupeIds = $this->user->groupes->pluck('id');
    }

    public function update()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->user->updateOrFail();
            $this->user->groupes()->sync($this->groupeIds);
            DB::commit();
            Flasher::addSuccess("User mis à jour avec succès !");
            $this->closeModal();
            $this->groupeIds = [];
        } catch (\Throwable $th) {
            DB::rollback();
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de la mise à jour !");
        }
    }
}
