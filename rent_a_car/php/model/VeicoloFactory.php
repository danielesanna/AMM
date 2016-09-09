<?php

include_once 'Db.php';
include_once 'Veicolo.php';
include_once 'ModelloFactory.php';
include_once 'NoleggioFactory.php';

class VeicoloFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare veicoli
     * @return \VeicoloFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VeicoloFactory();
        }

        return self::$singleton;
    }

    /**
     * Restituisce tutti i veicoli esistenti
     * @return array|\Veicolo
     */
    public function &getVeicoli() {
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getVeicoli] impossibile inizializzare il database");
            return array();
        }

        $query = "SELECT * from veicoli";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getVeicoli] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return array();
        }

        $toRet = self::inizializzaListaVeicoli($stmt);
        $mysqli->close();
        return $toRet;
    }

    /**
     * Popola una lista di veicoli con una query variabile
     * @param mysqli_stmt $stmt
     * @return array|\Veicolo
     */
    private function &inizializzaListaVeicoli(mysqli_stmt $stmt) {
        $veicoli = array();

        if (!$stmt->execute()) {
            error_log("[inizializzaListaVeicoli] impossibile" .
                    " eseguire lo statement");
            return $veicoli;
        }

        $id = 0;
        $idmodello = 0;
        $anno = 0;
        $targa = "";



        if (!$stmt->bind_result($id, $idmodello, $anno, $targa)) {
            error_log("[inizializzaListaVeicoli] impossibile" .
                    " effettuare il binding in output");
            return array();
        }
        while ($stmt->fetch()) {
            $veicolo = new Veicolo();
            $veicolo->setId($id);
            $veicolo->setModello(ModelloFactory::instance()->getModelloPerId($idmodello));
            $veicolo->setAnno($anno);
            $veicolo->setTarga($targa);
            $veicolo->setPrenotabile(NoleggioFactory::instance()->isVeicoloPrenotabile($id, "now"));
            $veicoli[] = $veicolo;
        }
        return $veicoli;
    }

    public function creaVeicoloDaArray($row) {
        $veicolo = new Veicolo();
        $veicolo->setId($row['veicoli_id']);
        $veicolo->setModello(ModelloFactory::instance()->getModelloPerId($row['veicoli_idmodello']));
        $veicolo->setAnno($row['veicoli_anno']);
        $veicolo->setTarga($row['veicoli_targa']);
        $veicolo->setPrenotabile(NoleggioFactory::instance()->isVeicoloPrenotabile($row['veicoli_id'], "now"));
        return $veicolo;
    }
    
    /**
     * Salva il veicolo passato nel database
     * @param Veicolo $veicolo
     * @return true se il salavataggio è andato a buon fine
     */
    public function nuovo($veicolo) {
        $query = "insert into veicoli (idmodello, anno, targa)
                  values (?, ?, ?)";

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[nuovo] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();

        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[nuovo] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('iis', $veicolo->getModello()->getId(), $veicolo->getAnno(), $veicolo->getTarga())){
        error_log("[nuovo] impossibile" .
                " effettuare il binding in input");
        $mysqli->close();
        return 0;
        }

        if (!$stmt->execute()) {
            error_log("[nuovo] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    /**
     * Cancella il veicolo che ha l'identificatore passato
     * @param int $id
     * @return true se la cancellazione è andata a buon fine
     */
    public function cancellaPerId($id) {
        $query = "delete from veicoli where id = ?";

        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cancellaPerId] impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();

        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cancellaPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('i', $id)){
        error_log("[cancellaPerId] impossibile" .
                " effettuare il binding in input");
        $mysqli->close();
        return 0;
        }

        if (!$stmt->execute()) {
            error_log("[cancellaPerId] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }
    
    /**
     * Restituisce il veicolo che ha l'identificatore passato
     * @param int $id Identificatore
     * @return \Veicolo
     */
    public function &getVeicoloPerId($id){
        $veicolo = new Veicolo();
        $query = "select * from veicoli where id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getVeicoloPerId] impossibile inizializzare il database");
            $mysqli->close();
            return $veicolo;
        }


        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getVeicoloPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $veicolo;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[getVeicoloPerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $veicolo;
        }

        if (!$stmt->execute()) {
            error_log("[getVeicoloPerId] impossibile" .
                    " eseguire lo statement");
            return $veicolo;
        }

        $id = 0;
        $idmodello = 0;
        $anno = 0;
        $targa = "";

        if (!$stmt->bind_result($id, $idmodello, $anno, $targa)) {
            error_log("[getVeicoloPerId] impossibile" .
                    " effettuare il binding in output");
            return $veicolo;
        }
        while ($stmt->fetch()) {
            $veicolo->setId($id);
            $veicolo->setAnno($anno);
            $veicolo->setTarga($targa);
            $veicolo->setModello(ModelloFactory::instance()->getModelloPerId($idmodello));
            $veicolo->setPrenotabile(NoleggioFactory::instance()->isVeicoloPrenotabile($id, "now"));
          }


        $mysqli->close();
        return $veicolo;
    }
}

?>
