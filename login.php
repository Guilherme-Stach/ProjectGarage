<?php
$page = "login.php";
session_start();
error_reporting(0);
include('db.php');

if (isset($_POST['login'])) {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
        error_reporting(E_ERROR | E_PARSE);
        $email = mysqli_real_escape_string($dbh,$_POST['email']);
        $password = mysqli_real_escape_string($dbh,$_POST['password']);
        
        $password = md5($password);

        $sql = 'SELECT user_id,email FROM users WHERE email = "'.$email.'"'.' and password = "'.$password.'"';

        $result = $dbh->query($sql);
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row["user_id"];

        if ($result->num_rows > 0) {
        echo '<h1><\h1>';

        $_SESSION['user']=$_POST['email'];

        header("location: index.php");
        } else {
            echo "<script type=\"text/javascript\">".
                "alert('Invalid Username/Password!');".
                "</script>";
        }

    }
}

if(strlen($_SESSION['user'])!=0)
	{
		
header('location:index.php');

}else{
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
                    <h2>Login</h2>
                </div>
                <div class="col-sm-12 contact clearfix">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 contact_right clearfix" style="border-left:0px">
                        <div class="contact_right_1 clearfix">
                        <form action="" method="post" style="text-align:center">
                            <input class="form-control" id="email" name="email" placeholder="Your Email*" type="email" required="required">
                            <br>
                            <input class="form-control" id="password" name="password" placeholder="Password*" type="password" required="required">
                            <br>
                            <button name="login" type="submit" class="custom_btn">Login</button>
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
<?php } ?>