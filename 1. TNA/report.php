<html>
<head>
<link rel='stylesheet' type='text/css' href='../../mis_table/DataTables example - jQuery UI styling_files/jquery-ui.css'>
<script src='../../mis_table/DataTables example - jQuery UI styling_files/jquery-1.12.4.js.download'>
</script>
<script src='../../mis_table/DataTables example - jQuery UI styling_files/jquery-ui.js'>
</script>

<script type="text/javascript">
$(function()
{
   $(".date_pick").datepicker({
       changeMonth : true,
       changeYear: true
   }).datepicker("option","dateFormat","ddmmyy"); 
});
</script>

</head>
<body>


<?php
  include_once("../../mis_table/get_table_data.php");
      
        $condition = "";
        $columns = "";
        $table = "training_need";
        get_table_data('ppc',$table,$columns,$condition,'');      
        //get_table_data_simple('payroll',$table,$columns,$condition,'1','example1');  
      
      
      
  ?>
</body>
</html>
