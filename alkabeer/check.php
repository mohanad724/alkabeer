<?php 

session_start();

if($_SESSION['teach_name']=="") {
    header("Location: index.php");
}

require 'dbcon.php';
$teacher =  $_SESSION['teach_name'];


if(isset($_POST['submit'])){

	$query = "SELECT * FROM `students` WHERE `teacher`='$teacher' ";
    $query_run = mysqli_query($con, $query);
					

   if(mysqli_num_rows($query_run) > 0)
	{
      foreach($query_run as $student)
                                        {
      if ($_POST[$student['id']] == "present") 
		{
												  
         $num = $student['id'];
		 $sql="UPDATE `students` SET `present`=`present`+1  WHERE `id`='$num' ";
	     $query_run = mysqli_query($con, $sql);
         
	    }
      else 
	   {
	    $num = $student['id'];
	    $sql="UPDATE `students` SET `absent`=`absent`+1  WHERE `id`='$num' ";
	     $query_run = mysqli_query($con, $sql);
        
	   }
	}
    header("Location: home.php");
}
}
	?>

	



<!doctype html>
<html  dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
	<link href="css/w3.css" rel="stylesheet">
	
      <title>الدورة الشتوية 2023</title>
    <script src="js/bootstrap.bundle.min.js"></script>
	
  </head>
   <body class="p-3 m-0 border-0 bd-example">
      <nav class="navbar  navbar-expand-lg w3-round-xlarge w3-margin-bottom "  style="background-color:#0099ff">
  <div class="container-fluid  ">
    <a class="navbar-brand" href="home.php">الصفحة الرئيسية</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color:$indigo-900">
      <span class="navbar-toggler-icon"></span>
    </button>
	
    <div class="collapse navbar-collapse " id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item w3-round-xlarge w3-margin-top" style="background-color:#0066ff" >
          <a class="nav-link w3-margin-right" href="check.php"><h5>  التفقد   </h5></a>
        </li>

        <li class="nav-item w3-round-xlarge" style="background-color:#0033ff">
          <a class="nav-link w3-margin-right" href="add_point.php"><h5>اضافة النقاط</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge"  style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href="signup.php"><h5>اضافة طالب</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge" style="background-color:#0033ff">
          <a class="nav-link w3-margin-right" href="stdlist.php"><h5> قائمة الطلاب</h5></a>
        </li>
		<li class="nav-item w3-round-xlarge" style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href="#"><h5> تعديل قائمة الطلاب</h5></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

   
   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   
   <table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">الاسم</th>
      <th scope="col">الاب</th>
      <th scope="col">النسبة</th>
	  <th scope="col">الحضور</th>
	 
    </tr>
		  </thead>
		  <tbody>
									<?php 
                                    
									$query = "SELECT * FROM `students` WHERE `teacher`='$teacher' ";
                                    $query_run = mysqli_query($con, $query);
									

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
											
                                            ?>
											
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['s_name']; ?></td>
                                                <td><?= $student['sp_name']; ?></td>
												<td><?= $student['s_lastname']; ?></td>
												
												<td>												
												<input type="radio" name="<?php echo $student['id']?>" required value="present">حضور<br>
												<input type="radio" name="<?php echo $student['id']?>" required value="pressnt">تأخر<br>
												<input type="radio" name="<?php echo $student['id']?>" required value="absent">غياب<br>
												</td>



												</div>
											
                                               
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
									<div  class="container-contact1-form-btn">
									<input class="btn btn-info btn-sm" type="submit"  name="submit" value="ارسال">
											</form>
  </body>
</html>