<?php

namespace App\Http\Livewire\App\Groupe;

use App\Models\GroupeRole;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GroupeRoleManagement extends Component
{
    public $groupe;
    public $roleData = [];
    public $groupeRoles = [];
    public $checkAll = false;

    public function updatedCheckAll()
    {
        foreach ($this->groupeRoles as $index => $groupeRole) {
            $this->groupeRoles[$index]['enabled'] = $this->checkAll;
        }
    }

    protected $rules = [
        'groupeRoles.*.enabled' => 'nullable',
        'checkAll' => 'nullable'
    ];

    public function mount()
    {
        $this->roleData = GroupeRole::whereGroupeId($this->groupe->id)
            ->with('role')
            ->get()
            ->groupBy('role.table_name')
            ->sortBy('role.ordre')
            ->all();
        $groupeRoles = $this->groupe->groupeRoles;
        $this->groupeRoles = [];
        foreach ($groupeRoles as $groupeRole) {
            $this->groupeRoles[$groupeRole->id] = $groupeRole;
        }
    }

    public function save()
    {
        try {
            DB::beginTransaction();
            foreach ($this->groupeRoles as $groupeRole) {
                $groupeRoleModel = GroupeRole::find($groupeRole['id']);
                $groupeRoleModel->update($groupeRole);
            }
            DB::commit();
            Flasher::addSuccess("Accès mis à jour avec succès !");
        } catch (\Throwable $th) {
            DB::rollBack();
            Flasher::addError($th->getMessage());
        }
    }

    public function checkRessource($ressource, $checked)
    {
        foreach ($this->roleData[$ressource] as $roleItem) {
            $this->groupeRoles[$roleItem['id']]['enabled'] = $checked;
        }
    }

    public function render()
    {
        return view('livewire.app.groupe.groupe-role-management');
    }
}
