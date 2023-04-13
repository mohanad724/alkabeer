<?php 

session_start();
if($_SESSION['teach_name']=="") {
    header("Location: index.php");
}
require 'dbcon.php';

 $teacher =  $_SESSION['teach_name'];
$sql_qry = "SELECT SUM(balance) AS count 
    FROM `students` 
    WHERE 1";

$duration = $con->query($sql_qry);
$record = $duration->fetch_array();
$total_balance = $record['count'];  



$sql_qry = "SELECT SUM(cash) AS count2
    FROM `students` 
    WHERE 1";

$duration = $con->query($sql_qry);
$record = $duration->fetch_array();
$total_cash = $record['count2'];



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

    <!-- <nav class="navbar  navbar-expand-lg w3-round-xlarge w3-margin-bottom "  style="background-color:#0099ff">
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
          <a class="nav-link w3-margin-right" href="select_check.php"><h5>طباعة شيك</h5></a>
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
</nav>-->
<div class="w3-panel w3-blue w3-card-4">
    
  <h3>الحصيلة النهائية لنقاط الطلاب :<?php echo $total_balance?></h3>
  <h3>القيمة النهائية للشيكات :<?php echo number_format($total_cash, 0, '', ',')?></h3>

</div>

<form action="print_check.php" method="post">
<table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">id</th>
	  <th scope="col">الرقم</th>
      <th scope="col">الاسم</th>
      <th scope="col">الاب</th>
      <th scope="col">النسبة</th>
      <th scope="col">الاستاذ</th>
	  <th scope="col">حصيلة النقاط</th>
       <th scope="col">قيمة الشيك</th>
	  <th scope="col">استلام</th>
    </tr>
  </thead>
  <tbody>
    <?php 
                  $query = "SELECT * FROM `students` ORDER BY `students`.`teacher` DESC";
									
                                    $query_run = mysqli_query($con, $query);
                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    { 
                                        foreach($query_run as $student)
                                        {
                                            ?>
											
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><? echo ++$i; ?></td>
                                                <td><?= $student['s_name']; ?></td>
                                                <td><?= $student['sp_name']; ?></td>
												 <td><?= $student['s_lastname']; ?></td>
                                                  <td><?= $student['teacher']; ?></td>
												 <td><?= $balance = ($student['present']*3)+($student['absent']*-2)+($student['pages']*1)+($student['libas']*2)+($student['add_point']);
													$num = $student['id'];
													$sql="UPDATE `students` SET `balance`='$balance'  WHERE `id`='$num'";
                                                    mysqli_query($con,$sql);
                                                    if ($balance < 0) {
                                                                $sql2="UPDATE `students` SET `cash`='0'  WHERE `id`='$num'";
                                                                mysqli_query($con,$sql2);

                                                            } 
                                                            else
                                                            {   
                                                                $cash = ceil(($balance *70) / 1000) * 1000; 
                                                                $sql2="UPDATE `students` SET `cash`='$cash'  WHERE `id`='$num'";
                                                                 mysqli_query($con,$sql2);

                                                            }
													
                                                    
                                                    
                                                    ?>
												</td>
                                               <td><?= $student['cash']; ?></td>
												 <td>
												<input class="w3-check"  type="checkbox"  value="<?php echo $student['id']?>" name="<?php echo $student['id']?>">
												
												</td>
												  
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
<button type="submit" name="submit"  class="btn btn-info btn-sm xlarge">اختيار</button>
<button type="submit" name="submit" onclick="window.print()" class="btn btn-info btn-sm xlarge">طباعة الصفحة </button>
</form>									
                                        
</section>
  </body>
</html>

