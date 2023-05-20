<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Competence;
use App\Models\CompetenceEmploye;
use App\Models\Contrat;
use App\Models\Sexe;
use App\Models\StatutContrat;
use App\Models\StatutProjet;
use App\Models\TypeContrat;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getCompetenceReport()
    {
        return Competence::select(['nom'])->withCount(['competenceEmployes as count'])
            ->whereHas('competenceEmployes')
            ->orderBy('nom')
            ->get();
    }

    public function getContratReport()
    {
        $data = [];
        foreach (StatutContrat::orderBy('nom')->get() as $statutContrat) {
            $data[] = ['label' => $statutContrat->nom, 'data' => TypeContrat::select(['nom'])->withCount(['contrats as count' => function ($q) use ($statutContrat) {
                $q->whereStatutContratId($statutContrat->id);
            }])
            ->whereHas('contrats')
                ->orderBy('nom')
                ->get()];
        }
        return $data;
    }

    public function getCertificationReport()
    {
        $data = [];
        $certificationActives = Certification::select(['nom'])
            ->withCount(['certificationEmployes as count' => function ($q) {
                $q->where('etat', true);
            }])
            ->whereHas('certificationEmployes')
            ->orderBy('nom')
            ->get();
        $data[] = ['label' => 'Active', 'data' => $certificationActives];
        $certificationInactives = Certification::select(['nom'])
            ->withCount(['certificationEmployes as count' => function ($q) {
                $q->where('etat', false);
            }])
            ->whereHas('certificationEmployes')
            ->orderBy('nom')
            ->get();
        $data[] = ['label' => 'Inactive', 'data' => $certificationInactives];
        return $data;
    }

    public function getEmployeSexeReport() {
        return Sexe::select('nom')
        ->withCount(['employes as count'=>function($q) {
            $q->whereEtat(true);
        }])
        ->get();
    }
}
