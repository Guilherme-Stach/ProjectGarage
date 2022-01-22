<?php
	$page = "contact.php";
	session_start();
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
	   <div class="service_main_top_inner">
	    <p>CONTACT US FOR ANY QUESTIONS</p>
	   </div>
	   <div class="center_1_top_inner_2">
	    <h2>Contacts</h2>
	   </div>
	 </div>
	</div>
   </div>
   </div>
  </section>
  
  
  <section id="contact" class="clearfix">
 <div class="container">
  <div class="row">
  <div class="col-sm-12 contact_top clearfix">
   <h2>Contact</h2>
  </div>
   <div class="col-sm-12 contact clearfix">
    <div class="col-sm-6 contact_left clearfix">
	 <div class="contact_left_1 clearfix">
	  <h3>HOW TO CONTACT US</h3>
	  <p>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.Class aptent taciti sociosqu ad.</p>
	 </div>
	 <div class="col-sm-12 contact_left_2 clearfix">
	  <div class="col-sm-6 contact_left_2_left clearfix">
	   <div class="contact_left_2_left_inner_1">
	    <h3>OFFICE</h3>
		<h5>775 Dublin, Ireland </h5>
	   </div>
	  </div>
	  <div class="col-sm-6 contact_left_2_right clearfix">
	   <div class="contact_left_2_left_inner_1">
	    <h3>CONTACT INFO</h3>
		<h5>Office: (888) 543-9898</h5>
		<h5>Fax: (888) 659-3290</h5>
		<h5>Email:<a href="#">infogersgarage@gmail.com</a></h5>
	   </div>
	  </div>
	 </div>
	</div>
	<div class="col-sm-6 contact_right clearfix">
	 <div class="contact_right_1 clearfix">
	  <input class="form-control form-control_1" id="name" name="name" placeholder="Your Name*" type="text" required="">
	  <input class="form-control form-control_1" id="name" name="name" placeholder="Your Email*" type="text" required="">
	  <input class="form-control form-control_1" id="name" name="name" placeholder="Your Subject*" type="text" required="">
	  <textarea id="edit-submitted-your-message" name="submitted[your_message]" cols="60" placeholder="Your Massage*" rows="5" class="form-textarea form-textarea_new" style="color: grey;"></textarea>
	  <p><a href="#">SUBMIT</a></p>
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
