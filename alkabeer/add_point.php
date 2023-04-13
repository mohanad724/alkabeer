<?php 

session_start();
if($_SESSION['teach_name']=="") {
    header("Location: index.php");
}
require 'dbcon.php';
$teacher =  $_SESSION['teach_name'];


if(isset($_POST['submit'])){

$studentid = $_POST['submit'];
$page = $_POST['page'];
if ($page < 1 )
$page = 0;
$libas = $_POST['libas'];
if ($libas != 1 )
$libas = 0;
$point = $_POST['point'];
if ($point <1)
$point =0;


 $sql="UPDATE `students` SET `pages`=pages+$page  , `add_point`=add_point+$point , `libas`=libas+$libas WHERE `id`='$studentid'";
 $query_run = mysqli_query($con, $sql);
                                          
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

  
   
   <table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">الاسم</th>
      <th scope="col">النسبة</th>
	  <th scope="col">الصفحات</th>
	   <th scope="col">لباس السنة</th>
	  <th scope="col">النقاط</th>
	  
	 
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
											 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['s_name']; ?></td>
                                               
												<td><?= $student['s_lastname']; ?></td>
												<td>
												<select name="page" required class="form-select" aria-label="Defadult select example">
												  <option selected>اختر</option>
												  <option value="1">صفحة</option>
												  <option value="2">صفحتان</option>
												  <option value="3">3</option>
												  <option value="4">4</option>
												  <option value="5">5</option>
												  <option value="6">6</option>
												</select>
												</td>
												<td>
												<input class="w3-check"  type="checkbox"  value="1" name="libas">
												<label><img src="new.png" </label>
												
												</td>
												
												<td>												
												<input type="radio" name="point" value="2">2<br>
												<input type="radio" name="point" value="4">4<br>
												<input type="radio" name="point" value="6">6<br>
												</td>
												<td>

												<div  class="container-contact1-form-btn">
												
												 <button type="submit" name="submit" value="<?=$student['id'];?>" class="btn btn-info btn-sm">ارسال</button>
												
											
												</div>
												</td>
											
                                               
                                            </tr>
											</form>
											
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

						
  </body>
</html>