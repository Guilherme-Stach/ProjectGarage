<?php
$page = "register.php";
session_start();
error_reporting(0);
include('db.php');
$error = Null;
$msg = Null;

if(isset($_GET['reg']))
{
	 
	$name= mysqli_real_escape_string($dbh,$_POST['name']);
	$email= mysqli_real_escape_string($dbh,$_POST['email']);
	$password= mysqli_real_escape_string($dbh,$_POST['password']);
	$mob= mysqli_real_escape_string($dbh,$_POST['mobile']);
	$address= mysqli_real_escape_string($dbh,$_POST['address']);

    $password = md5($password);


    $created_date = date("Y-m-d H:i:s");
    $hash = hexdec(sha1($email.$name.rand(100,10000).$created_date));
    $trimmedhash = substr($hash, 0, 8);
    $trimmedhash=str_replace('.','',$trimmedhash);
	

	$sql="INSERT INTO  users(user_id,name,password,email,phone,address) VALUES('$trimmedhash','$name','$password','$email','$mob','$address')";

	if($dbh->query($sql) === TRUE)
	{
	
		echo "<script type=\"text/javascript\">".
        		"alert('Congratulations, You have successfully registered with us');".
                "window.location.href='login.php';".
        	"</script>";
	}
	else 
	{
	
		echo "<script type=\"text/javascript\">".
        		"alert('Something went wrong. Please try again!');".
        	"</script>"; 
	}

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
  	    <?php include('head.php');?>
    </head>

    <style>
        .custom_btn {
            font-size: 14px;
            padding: 6px 12px 6px 12px;
            background: #ff5521;
            color: #FFFFFF;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid #e87513;
            border-radius: 5px;
            width: 100px;
            font-size: 20px;
        }
    </style>
<body>
  
  <?php include('header.php');?>
  <?php include('navbar.php');?>
           
    <section id="contact" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 contact_top clearfix" style="border-bottom:0px">
                    <h2>Register</h2>
                </div>
                <div class="col-sm-12 contact clearfix">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 contact_right clearfix" style="border-left:0px">
                        <div class="contact_right_1 clearfix">
                        <form action="register.php?reg" id="form1" style="text-align:center" name="register" method="post">
                            <div class="control-group">
                                <input type="text" class="form-control" id="name" name="name" maxlength="20" placeholder="Your Name" required>
                            </div>
                            <br>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" maxlength="60" name="email" placeholder="Your Email" required>
                            </div>
                            <br>
                            <div class="control-group">
                                <input type="password" class="form-control" id="password" maxlength="16" name="password" placeholder="Your Password" required>
                            </div>
                            <br>
                            <div class="control-group">
                                <input type="text" class="form-control" id="mobile" maxlength="10" name="mobile" placeholder="Your Mobile Number" required>
                            </div>
                            <br>
                            <div class="control-group">
                                <input type="text" class="form-control" id="address" maxlength="100" name="address" placeholder="Your Address" required>
                            </div>
                            <br>
                            <div>
                                <button class="custom_btn" name="register" type="submit">Register</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php');?> 	
</body>
</html>