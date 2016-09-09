<?php

include_once 'Costruttore.php';
include_once 'Db.php';

class CostruttoreFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Restiuisce un singleton per creare Costruttori
     * @return CostruttoreFactory
     */
    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CostruttoreFactory();
        }

        return self::$singleton;
    }

    public function &getCostruttorePerId($id) {
        $costruttore = new Costruttore();
        $query = "select * from costruttori where id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCostruttorePerId] impossibile inizializzare il database");
            $mysqli->close();
            return $costruttore;
        }


        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCostruttorePerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $costruttore;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[getCostruttorePerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $costruttore;
        }

        if (!$stmt->execute()) {
            error_log("[getCostruttorePerId] impossibile" .
                    " eseguire lo statement");
            return $costruttore;
        }

        $id = 0;
        $nome = "";

        if (!$stmt->bind_result($id, $nome)) {
            error_log("[getCostruttorePerId] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        while ($stmt->fetch()) {
            $costruttore->setId($id);
            $costruttore->setNome($nome);
        }
        

        $mysqli->close();
        return $costruttore;
    }

    /**
     * Restituisce la lista di tutti i Costruttori
     * @return array|\Costruttore
     */
    public function &getCostruttori() {

        $costruttori = array();
        $query = "select * from costruttori";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCostruttori] impossibile inizializzare il database");
            $mysqli->close();
            return $costruttori;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getCostruttori] impossibile eseguire la query");
            $mysqli->close();
            return $costruttori;
        }

        while ($row = $result->fetch_array()) {
            $costruttori[] = self::getCostruttore($row);
        }

        $mysqli->close();
        return $costruttori;
    }

    /**
     * Crea un oggetto di tipo Costruttore a partire da una riga del DB
     * @param type $row
     * @return \Costruttore
     */
    private function getCostruttore($row) {
        $costruttore = new Costruttore();
        $costruttore->setId($row['id']);
        $costruttore->setNome($row['nomecostruttore']);
        return $costruttore;
    }

}

?>
