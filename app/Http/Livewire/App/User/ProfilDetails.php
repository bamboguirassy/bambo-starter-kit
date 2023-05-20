<?php

namespace App\Http\Livewire\App\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilDetails extends Component
{
    public $user;

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.app.user.profil-details');
    }
}
