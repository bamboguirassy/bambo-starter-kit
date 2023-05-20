<?php

namespace App\Console\Commands;

use App\Models\Groupe;
use App\Models\GroupeRole;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SyncRolesCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $roleSuffixes = ['list', 'new', 'edit', 'show', 'delete'];
        $tables = DB::select('SHOW TABLES');
        try {
            DB::beginTransaction();
            foreach ($tables as $table) {
                foreach ($table as $tableName) {
                    // verifier s'il y'a un role pour cette table
                    $tableFinalName = Str::singular(join('', explode('_', $tableName)));
                    $isTableAlreadyAssociated = (Role::whereTableName($tableFinalName)->count() > 0);
                    if (!$isTableAlreadyAssociated) {
                        // get tableName
                        $this->info("Association en cours de $tableName...");
                        foreach ($roleSuffixes as $index=>$suffix) {
                            $role = new Role(['table_name'=>$tableFinalName,"ordre"=>$index+1,'nom'=>"{$tableFinalName}_{$suffix}"]);
                            $role->saveOrFail();
                            $this->info("role $role->nom généré");
                        }
                    } else {
                        $this->info("$tableName trouvée mais déja synchronisée...");
                    }
                }
            }
            // rechercher les groupes et tout associer si ce n'est le cas
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return Command::SUCCESS;
    }
}
