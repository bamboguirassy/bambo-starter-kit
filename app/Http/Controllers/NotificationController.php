<?php

namespace App\Http\Controllers;

use App\Custom\BreadcrumbItem;
use App\Models\Notification;
use App\Notifications\DemandeCongeNotification;
use App\Notifications\DisponibiliteMenuJourNotification;
use App\Notifications\ReponseDemandeCongeNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Liste des notifications";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des notifications'),
        ];
        return view('app.notification.index', compact('pageTitle', 'breadcrumbItems'));
    }

    /**
     * Manage notification show display.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        $notificationRoutes = [
            DemandeCongeNotification::class => route('app.demandeconge.index'),
            ReponseDemandeCongeNotification::class => route('app.mes-demandes.conge'),
            DisponibiliteMenuJourNotification::class => route('app.ma.restauration'),
        ];
        $notification->updateOrFail(['read_at'=>now()]);
        return redirect()->to($notificationRoutes[$notification->type]);
    }
}
