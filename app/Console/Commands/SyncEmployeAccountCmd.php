<?php

namespace App\Console\Commands;

use App\Models\Employe;
use App\Models\Groupe;
use App\Models\User;
use App\Models\UserGroupe;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SyncEmployeAccountCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:employe-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un compte pour tous les employés actifs qui n’ont pas de compte…
                             Et désactiver tous les comptes  actifs pour les employés inactifs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employesActifsSansComptes = Employe::where('etat', true)->whereNull('user_id')->get();
        $employesInactifsAvecComptesActifs = Employe::whereRelation('user', 'enabled', true)->where('etat', false)->get();

        try {
            $this->info("--------------Employé actif sans compte...");
            foreach ($employesActifsSansComptes as $employe) {
                // verifier si le mail est défini
                if (!$employe->email_professionnel) {
                    continue;
                }
                // verifier s'il n'ya pas de compte avec le mail de l'employé
                if (User::whereEmail($employe->email_professionnel)->count()) {
                    continue;
                }

                $user = new User([
                    'name' => "{$employe->prenoms} {$employe->nom}",
                    'email' => $employe->email_professionnel,
                    'password' => Hash::make('passer123'),
                    'role' => 'employe',
                    'enabled' => true
                ]);

                DB::beginTransaction();
                try {
                    $user->saveOrFail();
                    $employe->user_id = $user->id;
                    $employe->update();
                    $user->userGroupes()->save(new UserGroupe(['groupe_id' => Groupe::firstWhere('code', 'EMPLOYE')->id]));
                    $request = new \Illuminate\Http\Request();
                    $request->replace(['email' => $user->email]);
                    $user->sendResetLinkEmail($request);
                    DB::commit();
                    $this->info("$employe->name traité avec succès");
                } catch (\Throwable $th) {
                    $this->info("$employe->name traité avec erreur - $th->getMessage()");
                    Flasher::addError($th->getMessage());
                    DB::rollBack();
                }
            }
            $this->info("-------------Employés inactifs avec compte actif");
            foreach ($employesInactifsAvecComptesActifs as $employe) {
                $employe->user->updateOrFail(['enabled' => false]);
                $this->info("$employe->name");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        return Command::SUCCESS;
    }
}
