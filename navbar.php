<section id="top" class="cd-secondary-nav clearfix">
    
    <nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand"  href="index.php"><span class="dating_2"><img src="img/1.png"></span>Ger's<span class="dating_3">Garage</span><span class="dating_4">Service/Repair</span></a>
			</div>
			<div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
                    <li><a class="<?php echo ($page == "index.php" ? "active_tab" : "")?>" href="index.php">Home</a></li>

                    <?php
                        if(strlen(isset($_SESSION['user'])))
                        {
                            echo '<li><a class="'.($page == "booking.php" ? "active_tab" : "").'" href="booking.php">New Booking</a></li>';

                        }
                    ?>

                    <li><a class="<?php echo ($page == "service.php" ? "active_tab" : "")?>" href="service.php">Service</a></li>
                    <li><a class="<?php echo ($page == "faq.php" ? "active_tab" : "")?>" href="faq.php">FAQ</a></li>
                    <li><a class="<?php echo ($page == "contact.php" ? "active_tab" : "")?>" href="contact.php">Contact</a></li>
                    
                    <?php
                        if(strlen(isset($_SESSION['user'])))
                        {
                            echo '<li><a class="'.($page == "bookings.php" ? "active_tab" : "").'" href="bookings.php">Bookings</a></li>';
                            echo '<li><a class="'.($page == "profile.php" ? "active_tab" : "").'" href="profile.php">Profile</a></li>';

                        }
                    ?>

                    <?php
                            
                        if(strlen(isset($_SESSION['user'])))
                        {
                            echo '<li><a href="logout.php">Logout</a></li>';

                        }else{
                            echo '<li><a class="'.($page == "login.php" ? "active_tab" : "").'" href="login.php">Login</a></li>';
                            echo '<li><a class="'.($page == "register.php" ? "active_tab" : "").'" href="register.php">Register</a></li>';
                        }
                    ?>
				</ul>
			</div>
			</div>
		</div>
	</nav>

  </section>