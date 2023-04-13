<?php
session_start();
require 'dbcon.php';

if(isset($_POST['submit'])){


$query = "SELECT * FROM `students` WHERE 1 ";
    $query_run = mysqli_query($con, $query);
					

   if(mysqli_num_rows($query_run) > 0)
	{
      foreach($query_run as $student)
                                     {
      if ($_POST[$student['id']] == $student['id']) 
		{
			
		 echo ' <div class="w3-display-container">
				<img src="chek.jpg" alt="Girl in a jacket" style="width:100%;height:280px;">
				<div ><h5 style="position: absolute;top: 30px;right: 250px;width: 200px;height: 100px;">'.$student['s_name']." ".$student['sp_name']." ".$student['s_lastname']." ".'</h5></div>
                <div ><h5 style="position: absolute;top: 85px;right: 375px;width: 200px;height: 100px;">'.$student['cash']." ".'</h5></div>
				</div>';
	    echo " 
                                                 .......................................................................................................................................................";

	    }
}
	}
}

?>
<!doctype html>
<html  lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/w3.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
	
     <title>الدورة الشتوية 2023</title>
    <script src="js/bootstrap.bundle.min.js"></script>
	
 </head>
 <body >
 <div> 
<button type="submit" name="submit" onclick="window.print()" class="btn btn-info btn-sm">طباعة</button>
</div>
  </body>
</html>