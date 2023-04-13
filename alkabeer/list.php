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



<table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">الرقم العام</th>
      

      <th scope="col">الاسم</th>
      <th scope="col">الاب</th>
      <th scope="col">النسبة</th>
      <th scope="col">الاستاذ</th>
	  <th scope="col">حصيلة النقاط</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    echo $teacher; 
                                    $query = "SELECT * FROM `students` ORDER BY `students`.`balance` DESC";
									
                                    $query_run = mysqli_query($con, $query);
                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    { 
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><span style="font-weight:bold"><?= $student['id']; ?></span></td>
                                               
                                                <td><span style="font-weight:bold"><?= $student['s_name']; ?></span></td>
                                                <td><span style="font-weight:bold"><?= $student['sp_name']; ?></span></td>
												 <td><span style="font-weight:bold"><?= $student['s_lastname']; ?></span></td>
                                                  <td><span style="font-weight:bold"><?= $student['teacher']; ?></span></td>

												  <?$balance = ($student['present']*3)+($student['absent']*-2)+($student['pages']*1)+($student['libas']*2)+($student['add_point']);
                                                            $num = $student['id'];
                                                            if ($balance < 0) {
                                                                $sql="UPDATE `students` SET `balance`='0'  WHERE `id`='$num'";
                                                                mysqli_query($con,$sql);

                                                            } 
                                                            else
                                                            {   $sql="UPDATE `students` SET `balance`='$balance'  WHERE `id`='$num'";
                                                                mysqli_query($con,$sql);

                                                            }?>
												  <td><span style="font-weight:bold"><? if ($balance > 0) {echo $balance;}
                                                        else {echo "0";}?></td>
												
												  
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
<button type="submit" name="submit" onclick="window.print()" class="btn btn-info btn-sm">طباعة</button>
  </body>
</html>

