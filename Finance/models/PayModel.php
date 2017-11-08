<?php

class PayDatedModel {

    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getPayDatedModel() {

        $stmt = $this->pdo->prepare("SELECT statement_id, statement_type, DATE(statement_date) AS DATE, statement_amount, statement_note FROM statement");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>