<?php

$fferror=1;

if (isset($fferror) && $fferror == '1') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
}
$EXECUTE = filter_input(INPUT_GET, 'EXECUTE', FILTER_SANITIZE_SPECIAL_CHARS);

$TYPE = filter_input(INPUT_GET, 'TYPE', FILTER_SANITIZE_SPECIAL_CHARS);
$DATE = filter_input(INPUT_GET, 'DATE', FILTER_SANITIZE_SPECIAL_CHARS);
$AMOUNT = filter_input(INPUT_GET, 'AMOUNT', FILTER_SANITIZE_SPECIAL_CHARS);
$NOTE = filter_input(INPUT_GET, 'NOTE', FILTER_SANITIZE_SPECIAL_CHARS);


if(isset($EXECUTE)) {
    include('../includes/ADL_PDO_CON.php');
    if($EXECUTE == 1 ) {
        
        $ADD_PAYMENT = $pdo->prepare("INSERT INTO statement set statement_date=:DATE, statement_type=:TYPE, statement_amount=:AMOUNT, statement_note=:NOTE");
        $ADD_PAYMENT->bindParam(':DATE',$DATE, PDO::PARAM_STR);
        $ADD_PAYMENT->bindParam(':TYPE',$TYPE, PDO::PARAM_STR);
        $ADD_PAYMENT->bindParam(':AMOUNT',$AMOUNT, PDO::PARAM_STR);
        $ADD_PAYMENT->bindParam(':NOTE',$NOTE, PDO::PARAM_STR);
        $ADD_PAYMENT->execute();
        
    }
}