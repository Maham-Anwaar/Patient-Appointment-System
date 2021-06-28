<?php
 $id = "";
 if(isset($_GET['id']))
 {
 	session_start();
 	$_SESSION['userinfo']['Case']= " ";
 	$id = $_GET['id'];
 	$link = mysqli_connect("localhost", "root", "", "db1");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else
    {
    	echo "Hi";
    		if($id == "1")
    		{
    			$_SESSION['userinfo']['casetype'] = "Mild"; 
    		}
    		else if ($id == "2") 
    		{
    			$_SESSION['userinfo']['casetype'] = "Moderate";  			
    		}
    		else 
    		{
    			$_SESSION['userinfo']['casetype'] = "Severe"; 
    		}
    		 header("Location: dummy.php");
    }
 }
 else 
 	echo "No ID recieved";


?>
