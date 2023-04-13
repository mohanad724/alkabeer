<?php 

session_start();
if($_SESSION['teach_name']=="") {
    header("Location: index.php");
}
require 'dbcon.php';
$teacher =  $_SESSION['teach_name'];

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

      <nav class="navbar  navbar-expand-lg w3-round-xlarge w3-margin-bottom "  style="background-color:#0099ff">
     <div class="container-fluid  ">
    <a class="navbar-brand" href="admin.php">الصفحة الرئيسية</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color:$indigo-900">
      <span class="navbar-toggler-icon"></span>
    </button>
	
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item w3-round-xlarge w3-margin-top" style="background-color:#0066ff" >
          <a class="nav-link w3-margin-right" href="num_circul.php"><h5>  عدد الحلقات   </h5></a>
        </li>

        <li class="nav-item w3-round-xlarge" style="background-color:#0033ff">
          <a class="nav-link w3-margin-right" href=""><h5>اضافة النقاط</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge"  style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href=""><h5>اضافة طالب</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge" style="background-color:#0033ff">
          <a class="nav-link w3-margin-right" href="#"><h5> قائمة الطلاب</h5></a>
        </li>
		<li class="nav-item w3-round-xlarge" style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href="logout.php"><h5>تسجيل الخروج</h5></a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<table class="table table-success table-striped">
   <thead>
    <tr>
   

      <th scope="col">اسم الاستاذ</th>
      <th scope="col">عدد الطلاب</th>
      <th scope="col">الصف </th>

    </tr>
  </thead>
  <tbody>
    <?php 
    echo $teacher; 
                                    $query = "SELECT `teacher`, COUNT(*) as num FROM `students` GROUP BY `teacher`";
						
									
                                    $query_run = mysqli_query($con, $query);
                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    { 
                                        foreach($query_run as $array)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $array['teacher']; ?></td>
                                                <td><?= $array['num']; ?></td>
                                                 <td><?= $array['class']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> لايوجد طلاب مسجلة </h5>";
                                    }
                                ?>
    
  </tbody>
</table>
</section>
  </body>
</html>

