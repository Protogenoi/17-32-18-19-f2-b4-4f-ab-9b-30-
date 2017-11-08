<?php
if (isset($fferror)) {
    if ($fferror == '1') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}

$EXECUTE = filter_input(INPUT_GET, 'EXECUTE', FILTER_SANITIZE_NUMBER_INT);
$PAYMENT = filter_input(INPUT_GET, 'PAYMENT', FILTER_SANITIZE_SPECIAL_CHARS);
$SID = filter_input(INPUT_GET, 'SID', FILTER_SANITIZE_NUMBER_INT);

$DATETO = filter_input(INPUT_GET, 'DATETO', FILTER_SANITIZE_SPECIAL_CHARS);
$DATEFROM = filter_input(INPUT_GET, 'DATEFROM', FILTER_SANITIZE_SPECIAL_CHARS);

include('../includes/ADL_PDO_CON.php');
?>
<!DOCTYPE html>
<!-- 
 Copyright (C) ADL CRM - All Rights Reserved
 Unauthorised copying of this file, via any medium is strictly prohibited
 Proprietary and confidential
 Written by Michael Owen <michael@adl-crm.uk>, 2017
-->
<html lang="en">
    <title>Main</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/bootstrap-3.3.5-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/styles/Notices.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
            <link href="/img/favicon.ico" rel="icon" type="image/x-icon" />
            <script type="text/javascript" language="javascript" src="/js/jquery/jquery-3.0.0.min.js"></script>
            <script type="text/javascript" language="javascript" src="/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
            <script src="/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#DATE").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:-0"
            });
        });
        $(function () {
            $("#DATETO").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:-0"
            });
        });
        $(function () {
            $("#DATEFROM").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:-0"
            });
        });  
        $(function () {
            $("#EDITDATE").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:-0"
            });
        });           
    </script>
</head>
<body>

    <div class="container">
        
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4"><a data-toggle="modal" data-target="#SearchModal" class="btn btn-default btn-lg"><i class="fa fa-search"></i> Search payment history</a></div>
            <div class="col-md-4"><a data-toggle="modal" data-target="#AddModal" class="btn btn-default btn-lg"><i class="fa fa-plus"></i> Add a payment</a></div>
            </div>
        </div>
        
        <div class="col-md-12">
            <?php
            
            if(isset($EXECUTE)) {
                if($EXECUTE == 1) {
                    
        $QRY_EDIT = $pdo->prepare("SELECT statement_type, DATE(statement_date) AS DATE, statement_amount, statement_note FROM statement WHERE statement_id=:SID");
        $QRY_EDIT->bindParam(':SID', $SID, PDO::PARAM_STR);        
        $QRY_EDIT->execute();
        $row = $QRY_EDIT->fetch(PDO::FETCH_ASSOC);     
        
       if ($QRY_EDIT->rowCount() > 0) { 
           
         $EDIT_DATE=$row['DATE'];
         $EDIT_TYPE=$row['statement_type'];
         $EDIT_AMOUNT=$row['statement_amount'];
         $EDIT_NOTE=$row['statement_note'];
           
           ?>

<div class="col-md-12">
<div class="col-md-8">            
            <form action="php/Payments.php?SID=<?php echo $SID; ?>&EXECUTE=2" method="POST">
            <table class="table table-condensed">
                
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Update</th>
                </tr>  
                <tr>
                    
                    <td><input id="EDITDATE" name="DATE" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $EDIT_DATE; ?>" ></td>
                            <td><select name="TYPE">
                                    <option value="IN" <?php if(isset($EDIT_TYPE) && $EDIT_TYPE == 'IN') { echo "selected"; } ?> >IN</option>
                                    <option value="OUT" <?php if(isset($EDIT_TYPE) && $EDIT_TYPE == 'OUT') { echo "selected"; } ?> >OUT</option>
                        </select></td>
                    <td><input id="AMOUNT" name="AMOUNT" class="form-control" placeholder="" type="text" required="" value="<?php echo $EDIT_AMOUNT; ?>" ></td>
                    <td><textarea class="form-control" id="NOTE" name="NOTE"><?php echo $EDIT_NOTE; ?></textarea></td>
                    <td><button class="btn btn-warning btn-sm"><i class="fa fa-save"></i></button></td>
                </tr>
                  
            </table></form>
</div>
</div>
                    
        <?php        
        
       }
       
       }
            }
            
            if(isset($DATETO)) {
                
    /*require_once(__DIR__ . '/models/PayDatedModel.php');
    $PayDateModel = new PayDatedModel($pdo);
    $list = $PayDateModel->getPayDatedModel($DATEFROM,$DATETO);
    require_once(__DIR__ . '/views/PayDated-view.php');     */  
                
        $QRY_IN_SUM = $pdo->prepare("SELECT SUM(statement_amount) AS IN_AMOUNT FROM statement WHERE statement_type='IN' AND DATE(statement_date) BETWEEN :DATEFROM AND :DATETO");
        $QRY_IN_SUM->bindParam(':DATETO', $DATETO, PDO::PARAM_STR);
        $QRY_IN_SUM->bindParam(':DATEFROM', $DATEFROM, PDO::PARAM_STR);          
        $QRY_IN_SUM->execute();
        $row = $QRY_IN_SUM->fetch(PDO::FETCH_ASSOC);    
        
        $TOTAL_IN=$row['IN_AMOUNT'];
                if(empty($TOTAL_IN)) {
            $TOTAL_IN=0;
        }
        
        $QRY_OUT_SUM = $pdo->prepare("SELECT SUM(statement_amount) AS OUT_AMOUNT FROM statement WHERE statement_type='OUT' AND DATE(statement_date) BETWEEN :DATEFROM AND :DATETO ");
        $QRY_OUT_SUM->bindParam(':DATETO', $DATETO, PDO::PARAM_STR);
        $QRY_OUT_SUM->bindParam(':DATEFROM', $DATEFROM, PDO::PARAM_STR);       
        $QRY_OUT_SUM->execute();
        $result = $QRY_OUT_SUM->fetch(PDO::FETCH_ASSOC);    
        
        $TOTAL_OUT=$result['OUT_AMOUNT']; 
        if(empty($TOTAL_OUT)) {
            $TOTAL_OUT=0;
        }
        
        $TOTAL_BALANCE=$TOTAL_IN-$TOTAL_OUT;                
                
            $query = $pdo->prepare("SELECT statement_id, statement_type, DATE(statement_date) AS DATE, statement_amount, statement_note FROM statement WHERE DATE(statement_date) BETWEEN :DATEFROM AND :DATETO");
            $query->bindParam(':DATETO', $DATETO, PDO::PARAM_STR);
            $query->bindParam(':DATEFROM', $DATEFROM, PDO::PARAM_STR);
                
            }
            
            
            else {
                
        $QRY_IN_SUM = $pdo->prepare("SELECT SUM(statement_amount) AS IN_AMOUNT FROM statement WHERE statement_type='IN'");
        $QRY_IN_SUM->execute();
        $row = $QRY_IN_SUM->fetch(PDO::FETCH_ASSOC);    
        
        $TOTAL_IN=$row['IN_AMOUNT'];
                if(empty($TOTAL_IN)) {
            $TOTAL_IN=0;
        }
        
        $QRY_OUT_SUM = $pdo->prepare("SELECT SUM(statement_amount) AS OUT_AMOUNT FROM statement WHERE statement_type='OUT'");
        $QRY_OUT_SUM->execute();
        $result = $QRY_OUT_SUM->fetch(PDO::FETCH_ASSOC);    
        
        $TOTAL_OUT=$result['OUT_AMOUNT']; 
        if(empty($TOTAL_OUT)) {
            $TOTAL_OUT=0;
        }
        
        $TOTAL_BALANCE=$TOTAL_IN-$TOTAL_OUT;
            
            $query = $pdo->prepare("SELECT statement_id, statement_type, DATE(statement_date) AS DATE, statement_amount, statement_note FROM statement");
            
            }
            
            $query->execute();
            if ($query->rowCount() > 0) { ?>
            
            <div class="col-md-2">
            <table class="table table-condensed">
                <tr>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>BALANCE</th>
                </tr>
                <tr>
                    <td><span class="label label-success"><?php if(isset($TOTAL_IN)) { echo $TOTAL_IN; } ?></span></td>
                    <td><span class="label label-danger"><?php if(isset($TOTAL_OUT)) { echo $TOTAL_OUT; } ?></span></td>
                    <td><span class="label label-default"><?php if(isset($TOTAL_BALANCE)) { echo $TOTAL_BALANCE; } ?></span></td>
                </tr>
            </table>
            </div>
<div class="col-md-12">
<div class="col-md-8">            
            
            <table class="table table-condensed">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Update</th>
                </tr>
            <?php
            
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) { 
                
                $DB_DATE=$result['DATE'];
                $DB_TYPE=$result['statement_type'];
                $DB_AMOUNT=$result['statement_amount'];
                $DB_NOTE=$result['statement_note'];
                $DB_ID=$result['statement_id'];
                
                switch ($DB_TYPE):
                    case "IN":
                        $LABEL="success";
                        break;
                    case "OUT":
                        $LABEL="danger";
                        break;
                    default:
                        $LABEL="default";
                        endswitch;
                
                ?>
                
                <tr>
                    <td><?php echo $DB_DATE; ?></td>
                    <td><span class="label label-<?php echo $LABEL; ?>"><?php echo $DB_AMOUNT; ?></span></td>
                    <td><?php echo $DB_NOTE; ?></td>
                    <td><a href="?SID=<?php echo $DB_ID; ?>&EXECUTE=1" class="btn btn-warning btn-sm"><i class="fa fa-save"></i></a></td>
                </tr>
            
            <?php    } ?> </table>
</div>
 <?php  } ?>
</div>
        </div>
        
    </div>
    
<div id="AddModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new payment</h4>
      </div>
      <div class="modal-body">

<form class="form-horizontal" action="php/Payments.php?EXECUTE=1" method="POST">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="TYPE">Type</label>
  <div class="col-md-4">
    <select id="TYPE" name="TYPE" class="form-control">
      <option value="IN">IN</option>
      <option value="OUT">OUT</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="DATE">Date</label>  
  <div class="col-md-4">
  <input id="DATE" name="DATE" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="AMOUNT">Amount</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">£</span>
      <input id="AMOUNT" name="AMOUNT" class="form-control" placeholder="" type="text" required="">
    </div>
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="NOTE">Note</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="NOTE" name="NOTE"></textarea>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-8">
    <button id="" name="" class="btn btn-success">Add</button>
    <a id="CANCEL" name="CANCEL" class="btn btn-danger" data-dismiss="modal">Cancel</a>
  </div>
</div>

</fieldset>
</form>
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>    
    
<div id="SearchModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search payment history</h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal" action="" method="GET">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label" for="DATEFROM">Date from</label>  
  <div class="col-md-4">
  <input id="DATEFROM" name="DATEFROM" type="text" placeholder="" class="form-control input-md" required="" value="<?php if(isset($DATEFROM)) { echo $DATEFROM; } ?>">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="DATETO">Date to</label>  
  <div class="col-md-4">
  <input id="DATETO" name="DATETO" type="text" placeholder="" class="form-control input-md" required="" value="<?php if(isset($DATETO)) { echo $DATETO; } ?>">
    
  </div>
</div>    

<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-8">
    <button id="" name="" class="btn btn-success">Search</button>
    <a id="CANCEL" name="CANCEL" class="btn btn-danger" data-dismiss="modal">Cancel</a>
  </div>
</div>

</fieldset>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>       

</body>
</html>
