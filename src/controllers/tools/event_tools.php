<?php

namespace tools;

use models\organisation\Evenement;
use models\organisation\Periode_Evenement;
use models\organisation\Etat;

class event_tools
{
    public static function getAllEvents()
    {
        $event = new Evenement();
        $periode = new Periode_Evenement();
        $etat = new Etat();

        $events = $event->getAllLines();
        $periodes = $periode->getAllLines();
        $etats = $etat->getAllLines();

        $eventsAll = [];

        //mets tout dans une var
        foreach ($events as $event) {
            foreach ($periodes as $periode) {
                foreach ($etats as $etat) {

                    if ($periode['id_evenement_periode'] === $event['id_evenement'] && $etat['id_evenement'] === $event['id_evenement']) {
                        array_push($eventsAll, array_merge($event, array_merge($periode, $etat)));
                        break (2);
                    }
                }
            }
        }
        return $eventsAll;
    }
}
