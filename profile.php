<?php
	$page = "profile.php";
	session_start();
	error_reporting(0);
	include('db.php');

	//check if user is logged in
	if(strlen($_SESSION['user'])==0)
	{	
		header('location:index.php');
	}
	else{							

		$user_id = $_SESSION['user_id'];

		//query to get user details
		$sql = "select *  from users where user_id='$user_id'";
						
		// execute query
		$query = mysqli_query($dbh, $sql);
		
		//check if rows>0
		if (mysqli_num_rows($query)==0) {
			header('location:index.php');
		}
		
		//fetch data
		$row = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<?php include('head.php');?>
  </head>
<body>
  
  <?php include('header.php');?>
  <?php include('navbar.php');?>
  
  <section id="service" class="faq_main clearfix">
   <div class="service_main">
    <div class="container">
    <div class="row">
	 <div class="service_main_top clearfix">
	   <div class="center_1_top_inner_2">
	    <h2>Profile</h2>
	   </div>
	 </div>
	</div>
   </div>
   </div>
  </section>
  
  
  <section id="contact" class="clearfix">
 <div class="container">
  <div class="row">
   <div class="col-sm-12 contact clearfix">
    <div class="col-sm-6 contact_left clearfix">
	 <div class="contact_left_1 clearfix">
	  <h3>Name: <?php echo $row['name'];?></h3>
	  <h3>Email: <?php echo $row['email'];?></h3>
	  <h3>Mob No.: <?php echo $row['phone'];?></h3>
	  <h3>Address: <?php echo $row['address'];?></h3>
	</div>
	 </div>
	</div>
   </div>
   </div>
 </div>
</section>
  
  
	<?php include('footer.php');?> 	
  
</body>
 <script type="text/javascript">
$(document).ready(function(){

/*****Fixed Menu******/
var secondaryNav = $('.cd-secondary-nav'),
   secondaryNavTopPosition = secondaryNav.offset().top;
	$(window).on('scroll', function(){
		if($(window).scrollTop() > secondaryNavTopPosition ) {
			secondaryNav.addClass('is-fixed');	
		} else {
			secondaryNav.removeClass('is-fixed');
		}
	});	
	
});
</script>  
</html>

<?php } ?>