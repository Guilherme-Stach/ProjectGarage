<?php
	$page = "faq.php";
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
	    <p>DOLOR SIT AMET, CONSECTETUR ADIPISCING</p>
	   </div>
	   <div class="center_1_top_inner_2">
	    <h2>FAQ</h2>
	   </div>
	 </div>
	</div>
   </div>
   </div>
  </section>
  
  
  <section id="faq" class="clearfix">
  <div class="container">
   <div class="row">
    <div class="faq clearfix">
	 <div class="faq_top clearfix">
	  <h2>Aptent Taciti Sociosqu</h2>
	 </div>
	  <div class="faq_middle clearfix">
	   <div class="panel panel-primary">
                <div class="panel-heading clickable panel-collapsed">
                    <h3 class="panel-title">
                        <span class="faq_tab_1"><i class="glyphicon glyphicon-plus"></i></span>Sed nisi. Nulla quis sem at nibh elementum imperdiet sagittis?</h3>
                    
                </div>
                <div class="panel-body" style="display: none;">
                    <div class="faq_middle_inner clearfix">
					   <p><img src="img/36.jpg" width="100%"></p>
					   <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odionec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos C. Curabitursodales ligula in libero.</h5>
					</div>
            </div>
	</div>
	  </div>
	  <div class="faq_middle clearfix">
	   <div class="panel panel-primary">
                <div class="panel-heading clickable panel-collapsed">
                    <h3 class="panel-title">
                        <span class="faq_tab_1"><i class="glyphicon glyphicon-plus"></i></span>Fusce nec tellus augue semper porta mauris?</h3>
                    
                </div>
                <div class="panel-body" style="display: none;">
                    <div class="faq_middle_inner clearfix">
					   <p><img src="img/37.jpg" width="100%"></p>
					   <h5>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis semper 72,000 km's or as Vestibulum lacinia arcu eget Class aptent taciti.</h5>
					</div>
            </div>
	</div>
	  </div>
	  <div class="faq_middle clearfix">
	   <div class="panel panel-primary">
                <div class="panel-heading clickable panel-collapsed">
                    <h3 class="panel-title">
                        <span class="faq_tab_1"><i class="glyphicon glyphicon-plus"></i></span>Consectetur adipiscing elit. Integer nec?</h3>
                    
                </div>
                <div class="panel-body" style="display: none;">
                    <div class="faq_middle_inner clearfix">
					   <p><img src="img/38.jpg" width="100%"></p>
					    <h5>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis semper 72,000 km's or as Vestibulum lacinia arcu eget Class aptent taciti.</h5>
					</div>
            </div>
	</div>
	  </div>
	  <div class="faq_middle clearfix">
	   <div class="panel panel-primary">
                <div class="panel-heading clickable panel-collapsed">
                    <h3 class="panel-title">
                        <span class="faq_tab_1"><i class="glyphicon glyphicon-plus"></i></span>Nulla quis sem at nibh elementum imperdiet?</h3>
                    
                </div>
                <div class="panel-body" style="display: none;">
                    <div class="faq_middle_inner clearfix">
					   <p><img src="img/39.jpg" width="100%"></p>
					   <h5>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis semper 72,000 km's or as Vestibulum lacinia arcu eget Class aptent taciti.</h5>
					</div>
            </div>
	</div>
	  </div>
	  <div class="faq_middle clearfix">
	   <div class="panel panel-primary">
                <div class="panel-heading clickable panel-collapsed">
                    <h3 class="panel-title">
                        <span class="faq_tab_1"><i class="glyphicon glyphicon-plus"></i></span>Curabitursodales ligula in libero dignissim?</h3>
                    
                </div>
                <div class="panel-body" style="display: none;">
                    <div class="faq_middle_inner clearfix">
					   <p><img src="img/40.jpg" width="100%"></p>
					  <h5>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis semper 72,000 km's or as Vestibulum lacinia arcu eget Class aptent taciti.</h5>
					</div>
            </div>
	</div>
	  </div>
   </div>
  </div>
  </div>
 </section>
  
  <section id="gallery_2" class="clearfix">
   <div class="head_gallery">
    <div class="container">
    <div class="row">
	 <div class="gallery_2 clearfix">
	 <h2>Praesent mauris, Fusce nec tellus sed</h2>
	 <p>Aptent taciti sociosqu ad litora torquent conubia nostra, per inceptos C. Curabitursodales ligula<br> nibh elementum imperdiet.</p>
	 <h3>Call: <a href="#"> 1-524-916-9922</a></h3>
	 <h5><a href="#">Make an designation</a></h5>
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
 <script type="text/javascript">
	$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minu');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-plus');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-plus');
    }
});
$(document).ready(function () {
    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();
});

	</script>   
</html>
