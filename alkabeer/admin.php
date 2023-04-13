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
$total = $record['count'];




if(isset($_POST['submit'])){

$studentid = $_POST['submit'];
$point = 0;
$point = $_POST['point'];



 $sql="UPDATE `students` SET `add_point`=add_point+$point WHERE `id`='$studentid'";
 $query_run = mysqli_query($con, $sql);
                                          
}
function send_whatsapp($message="Test"){
    $phone="+963945329291";  // Enter your phone number here
    $apikey="7004457";       // Enter your personal apikey received in step 3 above

    $url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;

    if($ch = curl_init($url))
    {
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $html = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // echo "Output:".$html;  // you can print the output for troubleshooting
        curl_close($ch);
        return (int) $status;
    }
    else
    {
        return false;
    }
}
send_whatsapp("مرحبا بك");  
$sql2 = "SELECT * FROM `TABLE 22`";
 $query_run = mysqli_query($con, $sql2);
  foreach($query_run as $abs)
                                        {
                                          echo $abs['COL 1'];}
 
 print_r($query_run);


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
          <a class="nav-link w3-margin-right" href="select_check.php"><h5>طباعة شيك</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge"  style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href="alfajerKnights.php"><h5>فرسان الفجر</h5></a>
        </li>
        <li class="nav-item w3-round-xlarge" style="background-color:#0033ff">
          <a class="nav-link w3-margin-right" href="list.php"><h5> قائمة الطلاب</h5></a>
        </li>
		<li class="nav-item w3-round-xlarge" style="background-color:#0066ff">
          <a class="nav-link w3-margin-right" href="logout.php"><h5>تسجيل الخروج</h5></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="w3-panel w3-blue w3-card-4">
  <p>الاستاذ :<?php echo $teacher?></p>
</div>
<h1><?echo "total is : ".$total;?> </h1> 
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="بحث ...">

<table  id="myTable" class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">id</th>
      
<th scope="col">الرقم</th>
      <th scope="col">الاسم</th>
      <th scope="col">الاب</th>
      <th scope="col">النسبة</th>
      <th scope="col">الاستاذ</th>
      <th scope="col">الرقم</th>
      <th scope="col">المواليد</th>
      <th scope="col">اضافة او حسم نقاط</th>
      <th scope="col">ايام الحضور</th>
      <th scope="col">الصفحات المُسمعة</th>
       <th scope="col">النقاط المُضافة</th>
	  <th scope="col">حصيلة النقاط</th>
    </tr>
  </thead>
  <tbody>
    <?php 
   
                                    $query = "SELECT * FROM `students` ORDER BY `students`.`id` ASC";
									
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
                                                 <td><?= $student['s_number']; ?></td>
                                                 <td><?= $student['bitrthday']; ?></td>
                                                  <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                    <input type="text" name="point" >
                                                    <button type="submit" name="submit" value="<?=$student['id'];?>" class="btn btn-info btn-sm">اضافة</button>
                                                </form></td>
                                                 <td><?= $student['present']; ?></td>
                                                 <td><?= $student['pages']; ?></td>
                                                 <td><?= $student['add_point']; ?></td>
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
												  <td><? if ($balance > 0) {echo $balance;}
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
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

  </body>
</html>

