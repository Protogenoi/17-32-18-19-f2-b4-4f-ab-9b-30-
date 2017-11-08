<?php

class PayDatedModel {

    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPayDatedModel($DATEFROM,$DATETO) {

        $stmt = $this->pdo->prepare("SELECT statement_id, statement_type, DATE(statement_date) AS DATE, statement_amount, statement_note FROM statement WHERE DATE(statement_date) BETWEEN :DATEFROM AND :DATETO");
        $stmt->bindParam(':DATEFROM', $DATEFROM, PDO::PARAM_STR);
        $stmt->bindParam(':DATETO', $DATETO, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>