<?php

session_start();



include "dbcon.php"; 
//check if form is submitted
if (isset($_POST['login'])) {

    $teach_name = mysqli_real_escape_string($con, $_POST['teach_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    

	$sql = "SELECT * FROM `teachers` WHERE `teach_name` = '$teach_name' and `password` = '$password' ";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['teach_id'] = $row['id'];
        $_SESSION['teach_name'] = $row['teach_name'];
		
        header("Location: home.php");
	   echo $_SESSION['usr_name'];
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
  if( $_SESSION['teach_name'] == "admin" ) {
        header("Location: admin.php");}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/w3.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
	
    <title>الدورة الشتوية 2023</title>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
<section class="w3-opacity" style="background-image: url(back1.jpg); background-repeat: no-repeat;background-position: center; background-size: cover;width: 100%;height: 100%;" >
 </section>


<div class="w3-display-middle">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform"  >
                <fieldset class=" w3-Light-Gray w3-round-xxlarge">
				
                 <div class="w3-display-topmiddle">
				<B>تسجيل الدخول</B>
				</div> <br>

                    
                    <div class="form-group">
                        <label for="name"><B>اسم الاستاذ</b></label>
                        <input type="text" name="teach_name" placeholder="الاسم" required  class="w3-input w3-border" >
                    </div>

                    <div class="form-group">
                        <label for="name"><b>كلمة السر</b></label>
                        <input type="password" name="password" placeholder="كلمة السر" required  class="w3-input w3-border">
                    </div><br>

                   
                        <input type="submit" name="login" value="التسجيل"  class="w3-button w3-round-xlarge  w3-block w3-blue" >
                    
                </fieldset>
            </form>
			
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>


</body>
</html>