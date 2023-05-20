<?php

namespace App\Http\Livewire\App\User;

use App\Models\User;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required|current_password',
        'password' => 'required|min:8',
        'password_confirmation' => 'required_with:password|min:8|same:password',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.app.user.change-password');
    }

    public function updatePassword()
    {
        $this->validate();
        try {
            $user = User::find(Auth::id());
            $user->updateOrFail([
                'password' => Hash::make($this->password),
            ]);
            Flasher::addSuccess("Mot de passe mis à jour avec succès !");
            $this->password = '';
            $this->password_confirmation = '';
            $this->current_password = '';
        } catch (\Throwable $th) {
            Flasher::addError($th->getMessage());
            Flasher::addError("Erreur lors de la mise à jour !");
        }
    }
}
