<?php 

session_start();
require 'dbcon.php';
$idnow = 0;
$mydate = "";
$query3 = "SELECT `date` FROM `alfrsan2` where `num` = '1' ";					
$query_run = mysqli_query($con, $query3);
if (mysqli_num_rows($query_run) > 0) {
  
  while($row = mysqli_fetch_assoc($query_run)) {
    $mydate = $row['date'];
echo "the date is " .$mydate;
  }
} else {
  echo "0 results";
}


if(isset($_POST['date'])){
    $mydate = $_POST['mydate'];
    
    $insert1 ="UPDATE `alfrsan2` SET `date` = '$mydate' WHERE `num` = '1'";
    mysqli_query($con ,$insert1);
    
}


if($_SESSION['teach_name']=="") {
header("Location: index.php");
}


if(isset($_POST['submit'])){
$idnow = $_POST['idnow'];
                                          
}
$query1 ="SELECT id FROM `alfrsan2` WHERE id = '$idnow' ";
$query_run = mysqli_query($con, $query1);
if(mysqli_num_rows($query_run) > 0)
   {        
        $query2="UPDATE `alfrsan2` SET `$mydate`= '1' WHERE `id`='$idnow'";
        $query_run = mysqli_query($con, $query2);
           
   }
   else
   {
       $query3 = "SELECT * FROM `students` where 1";
						
       $query_run = mysqli_query($con, $query3);
       if(mysqli_num_rows($query_run) > 0)
         { 
            foreach($query_run as $student)
              {
                                            
                if ($idnow == $student['id'])
                    {
                        $id = $student['id'];
                        $s_name = $student['s_name'];
                        $s_lastname = $student['s_lastname'];

                       $query4 = "INSERT INTO `alfrsan2`(`id`, `s_name`, `s_lastname`, `$mydate`) VALUES ('$id','$s_name','$s_lastname','1')";
                       $query_run = mysqli_query($con, $query4);

                      echo $student['id'];  
                    }   
                                
              }
        }  
   }

if(isset($_POST['signup'])){

	$s_name =($_POST['s_name']);
    $s_lastname =($_POST['s_lastname']);
 
   $insert = "insert into students( `s_name`, `s_lastname`) "
            . "values('$s_name','$s_lastname')";
    
if (mysqli_query($con, $insert)) {
    
    echo $s_name .":::". $s_lastname; 

} 
else
 {
  echo "Error: " . $query2 . "<br>" . mysqli_error($con);
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
        <li class="nav-item w3-round-xlarge" style="background-color:#0066ff">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="w3-container w3-card-4">
<libal>تاريخ اليوم </libal>
<input class="" type="text" placeholder="the date"  name="mydate" >

 <button type="submit" name="date" class="w3-circle">ارسال</button>
</div>
<br>
</form>
        </li>
              </ul>
    </div>
  </div>
</nav>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="w3-container w3-card-4">

<input class="w3-input w3-border w3-round" type="text"  name="idnow" id="InputBoxID">
<br>
 <button type="submit" name="submit" class="btn btn-info btn-sm w3-block w3-xlarge">ارسال</button>
</div>
<br>
</form>
<div class="w3-responsive">
  
<table  id="myTable" class="table table-success w3-table-all table-striped ">
   <thead>
    <tr>
      <th scope="col">id</th>
      
        
      <th scope="col">الاسم</th>
       <th scope="col">الللقب</th>
      
      <? for ($i=24 ; $i<=31;$i++)
      {
        ?><th scope="col"><?echo $i."/1"?></th>
<?}?> 
      
     
    </tr>
  </thead>
  <tbody>
    <? 
   
                                    $query = "SELECT * FROM `alfrsan2` where 1";
									
                                    $query_run = mysqli_query($con, $query);
                                    

                                    if(mysqli_num_rows($query_run) > 0)
                                    { 
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                               
                                                <td><?= $student['s_name']; ?></td>
                                                <td><?= $student['s_lastname']; ?></td>
											       <? for ($i=24; $i<=31;$i++)
                                                        {
                                                            $var = $i."-1";
                                                            
                                                            ?><td><?= $student[$var]; ?></td>
                                                            <?}?> 
                                                 
												  
											</tr>
                                            <? 
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> لايوجد طلاب مسجلة </h5>";
                                    }
                                ?>
    
  </tbody>
</table>
</div>

	<form action="<?php  echo $_SERVER["PHP_SELF"]; ?>" method="post"  class="w3-container" accept-charset="utf8_general_ci" >
			
            
				 <div  class="wrap-input1 validate-input" >   	

				<h2 ><b>اسم الطالب</b></h2>
  
                 <input  class="w3-input w3-border" type="text" name="s_name"   placeholder="اسم الطالب" required="">
				 <span class="shadow-input1"></span>
				 </div>
				 
				 
				<div  class="wrap-input1 validate-input"  data-validate = "Name is required"> 
				  <h2 ><b>اللقب </b></h2>
  				
                 <input class="w3-input w3-border" type="text" name="s_lastname"  placeholder="اللقب او النسبة" required="">
				 <span class="shadow-input1"></span>
				 </div>	
                                     
				<div  class="container-contact1-form-btn">
				<input class="btn btn-info btn-sm" type="submit"  name="signup" value="تسجيل">
									
				</div>
		</form>
<button type="submit" name="submit" onclick="window.print()" class="btn btn-info btn-sm xlarge">طباعة الصفحة </button>
<script>
window.onload = function(){
   document.getElementById("InputBoxID").focus();
};
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

