<?php 
session_start();
session_unset(); 
?>
<!doctype html>
<html lang="en" style="background-color:#EDF0F5">

<head>
    <meta charset="utf-8" />
    
</head>

<body  style="overflow:hidden;">
    
	<center>
		<h3 style="color:black; padding-top:300px;"> Authentication Error... You will be redirected to login page after <span id="countdowntimer">3</span> seconds</h3></center>

		<script type="text/javascript">
			var timeleft = 3;
			var downloadTimer = setInterval(function(){
			timeleft--;
			document.getElementById("countdowntimer").textContent = timeleft;
			if(timeleft <= 0)
				location.href="../index.php";
				
			},1000);
			
		</script>
		
	</body>


</html>