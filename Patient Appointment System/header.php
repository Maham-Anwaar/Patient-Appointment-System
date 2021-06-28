
<!--For when session is not set -->
<!DOCTYPE html>
<html>
<head>
	
 	<link rel="stylesheet" href="css/header.css">	
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet"  href="css/main.css">
     <link rel="stylesheet" href="css/style.css">
       

</head>

</head>
<body>

<div class="header">
	<?php
         session_start();
         echo '<a href="index.php" class="logo">Home</a>';
        if(isset($_SESSION['userinfo'])){
              echo '<div class="header-right">';
				echo '<a href="dummy.php">Appointmnet</a>';
				echo '<a href="logout.php">Logout</a>';	
        }
        else{
            	echo '<div class="header-right">';
				echo '<a href="login.php">Login</a>';
				echo '<a href="Signup.php">Signup</a>';
        } ?>
  

</div>

</body>
</html>