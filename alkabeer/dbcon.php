




<?php 
$host  = "sql306.epizy.com";
$dbuser = "epiz_32649263";
$dbpass ="Dgm9HvgZsT";
$dbname ="epiz_32649263_alkabeer"; 




@$con = mysqli_connect($host , $dbuser , $dbpass ,$dbname );

mysql_query("set character_set_server='utf8'");
mysql_query("set names 'utf8'");

if ( !$con ) {
 echo "no connect " ;
 }
 

 ?>

 

 




