<div class="col-md-12">
<div class="col-md-8">            
            
            <table class="table table-condensed">
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Notes</th>
                    <th>Update</th>
                </tr>
                
<?php foreach ($list as $result): ?>

<?php

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
    
<?php endforeach ?>
</table>
</div>
</div>
