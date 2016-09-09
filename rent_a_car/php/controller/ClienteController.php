<?php

include_once 'BaseController.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai clienti
 *
 */
class ClienteController extends BaseController {

    /**
     * Costruttore
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Restituisce il timestamp odierno, calcolato a mezzanotte
     * @return int
     */
    private static function oggi() {
        return strtotime("now") - strtotime("now") % 86400;
    }

    /**
     * Metodo per gestire l'input dell'utente. 
     * @param type $request la richiesta da gestire
     */
    public function handleInput(&$request) {

        // creo il descrittore della vista
        $vd = new ViewDescriptor();


        // imposto la pagina
        $vd->setPagina($request['page']);


        // gestion dei comandi
        // tutte le variabili che vengono create senza essere utilizzate 
        // direttamente in questo switch, sono quelle che vengono poi lette
        // dalla vista, ed utilizzano le classi del modello

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home

            $this->showLoginPage($vd);
        } else {
            // utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);


            // verifico quale sia la sottopagina della categoria
            // Cliente da servire ed imposto il descrittore 
            // della vista per caricare i "pezzi" delle pagine corretti
            // tutte le variabili che vengono create senza essere utilizzate 
            // direttamente in questo switch, sono quelle che vengono poi lette
            // dalla vista, ed utilizzano le classi del modello
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // modifica dei dati anagrafici
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;

                    // visualizzazione dei noleggi richiesti
                    case 'noleggi':
                        $noleggi = NoleggioFactory::instance()->noleggiPerCliente($user);
                        $vd->setSottoPagina('noleggi');
                        break;

                    //visualizzazione del parco auto
                    case 'veicoli':
                        $veicoli = VeicoloFactory::instance()->getVeicoli();
                        //print_r($veicoli);
                        $vd->setSottoPagina('parco_auto');
                        break;

                    default:

                        $vd->setSottoPagina('home');
                        break;
                }
            }



            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                // abbiamo ricevuto un comando
                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    // aggiornamento indirizzo
                    case 'indirizzo':

                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio email
                    case 'email':
                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Email aggiornata");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio password
                    case 'password':
                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeCliente($vd);
                        break;

                    //form per la prenotazione di un veicolo
                    case 'prenota':
                        $idveicolo = filter_var($request['veicolo'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                        if (isset($idveicolo)) {

                            $vd->setSottoPagina('prenotazione');
                        }
                        $this->showHomeCliente($vd);
                        break;

                    //creazione di una nuova prenotazione
                    case 'nuova_prenotazione':
                        $vd->setSottoPagina('parco_auto');
                        $msg = array();
                        $nuova = new Noleggio();

                        $nuova->setVeicolo(VeicoloFactory::instance()->getVeicoloPerId($request['idveicolo']));
                        $nuova->setCliente($user);
                        $datainizio = DateTime::createFromFormat("Y-m-d", ($request['datainizio']));
                        $datafine = DateTime::createFromFormat("Y-m-d", ($request['datafine']));

                        if ($datainizio) {
                            if ($datainizio->getTimeStamp() >= $this->oggi()) {
                                $nuova->setDatainizio($request['datainizio']);
                            } else {
                                $msg[] = '<li> Inserire una data di inizio valida </li>';
                            }
                        } else {
                            $msg[] = '<li> Inserire una data di inizio valida </li>';
                        }

                        if ($datafine) {
                            if ($datafine->getTimeStamp() >= $this->oggi()) {
                                $nuova->setDatafine($request['datafine']);
                            } else {
                                $msg[] = '<li> Inserire una data di inizio valida </li>';
                            }
                        } else {
                            $msg[] = '<li> Inserire una data di fine valida </li>';
                        }
                        
                        
                        if (count($msg) == 0) {
                            if($datafine->getTimeStamp() < $datainizio->getTimeStamp()){
                                $msg[] = '<li>La data di inizio è successiva alla data di fine</li>';
                            }
                        }

                        //controllo che il veicolo sia libero tutti i giorni della prenotazione
                        if (count($msg) == 0) {
                            $costo = (($datafine->getTimeStamp() - $datainizio->getTimeStamp()) / 86400 + 1 ) * $nuova->getVeicolo()->getModello()->getPrezzo();
                            $nuova->setCosto($costo);
                            $flag = true;
                            $iteratore = $datainizio->getTimeStamp();
                            $fine = $datafine->getTimeStamp();
                            while ($iteratore <= $fine && $flag) {
                                //$msg[] = '<li>Iteratore '.$iteratore.'</li>';
                                if (!NoleggioFactory::instance()->isVeicoloPrenotabile($request['idveicolo'], $iteratore)) {
                                    $msg[] = '<li> Il veicolo non è prenotabile per tutto l\'intervallo scelto</li>';
                                    $flag = false;
                                }
                                $iteratore += 86400;
                            }
                        }

                        if (count($msg) == 0) {
                            if (NoleggioFactory::instance()->nuovo($nuova) != 1) {
                                $msg[] = '<li> Impossibile creare la prenotazione </li>';
                            }
                        }

                        $this->creaFeedbackUtente($msg, $vd, "Prenotazione aggiunta, costo: ". $nuova->getCosto()." €");
                        $veicoli = VeicoloFactory::instance()->getVeicoli();
                        $this->showHomeUtente($vd);
                        break;


                    default : $this->showLoginPage($vd);
                }
            } else {
                // nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }

        // includo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

}

?>
