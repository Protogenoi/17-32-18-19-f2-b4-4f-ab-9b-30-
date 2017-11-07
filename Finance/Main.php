<?php
if (isset($fferror)) {
    if ($fferror == '1') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}

$EXECUTE = filter_input(INPUT_GET, 'EXECUTE', FILTER_SANITIZE_SPECIAL_CHARS);
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
    </div>
    
<div id="AddModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new payment</h4>
      </div>
      <div class="modal-body">

<form class="form-horizontal">
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
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>       

</body>
</html>
