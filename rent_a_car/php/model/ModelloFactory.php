<?php

include_once 'Costruttore.php';
include_once 'CostruttoreFactory.php';
include_once 'Modello.php';
include_once 'Db.php';

class ModelloFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare Modelli
     * @return ModelloFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new ModelloFactory();
        }

        return self::$singleton;
    }

    /**
     * Restituisce il modello che ha l'identificatore passato
     * @param int $id
     * @return \Modello
     */
    public function &getModelloPerId($id) {
        $modello = new Modello();
        $query = "select * from modelli where id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getModelloPerId] impossibile inizializzare il database");
            $mysqli->close();
            return $modello;
        }


        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getModelloPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $modello;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[getModelloPerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $modello;
        }

        if (!$stmt->execute()) {
            error_log("[getModelloPerId] impossibile" .
                    " eseguire lo statement");
            return $modello;
        }

        $id = 0;
        $nomemodello = "";
        $idcostruttore = 0;
        $cilindrata = 0;
        $potenza = 0;
        $prezzo = 0;

        if (!$stmt->bind_result($id, $nomemodello, $idcostruttore, $cilindrata, $potenza, $prezzo)) {
            error_log("[getModelloPerId] impossibile" .
                    " effettuare il binding in output");
            return $modello;
        }
        while ($stmt->fetch()) {
            $modello->setId($id);
            $modello->setNome($nomemodello);
            $modello->setCostruttore(CostruttoreFactory::instance()->getCostruttorePerId($idcostruttore));
            $modello->setCilindrata($cilindrata);
            $modello->setPotenza($potenza);
            $modello->setPrezzo($prezzo);
        }


        $mysqli->close();
        return $modello;
    }

    /**
     * Restituisce la lista di tutti i Modelli
     * @return array|\Modello
     */
    public function &getModelli() {

        $modelli = array();
        $query = "select * from modelli";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getModelli] impossibile inizializzare il database");
            $mysqli->close();
            return $modelli;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getModelli] impossibile eseguire la query");
            $mysqli->close();
            return $modelli;
        }

        while ($row = $result->fetch_array()) {
            $modelli[] = self::getModello($row);
        }

        $mysqli->close();
        return $modelli;
    }

    /**
     * Crea un oggetto di tipo Modello a partire da una riga del DB
     * @param type $row
     * @return \Modello
     */
    private function getModello($row) {
        $modello = new Modello();
        $modello->setId($row['id']);
        $modello->setNome($row['nomemodello']);
        $modello->setCostruttore(CostruttoreFactory::instance()->getCostruttorePerId($row['idcostruttore']));
        $modello->setCilindrata($row['cilindrata']);
        $modello->setPotenza($row['potenza']);
        $modello->setPrezzo($row['prezzo']);
        return $modello;
    }

}

?>
