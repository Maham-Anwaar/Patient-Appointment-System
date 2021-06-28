
<?php
$get_id="";
$patientGuy="";
if(isset($_GET['id'])){
	$link = mysqli_connect("localhost", "root", "", "db1");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    else
    {
    	$get_id = $_GET['id'];	
    	// Fetch existing data 
    	$query = "SELECT * from appointments where aID = $get_id";
    	 $result = mysqli_query($link , $query);

        if (!$result)
        {
            echo "not executed1";
            
        } 
        $row = mysqli_fetch_assoc($result);
        $appointmentDate = $row["apDate"];
		$patientGuy = $row["p_ID"];
    	$query1 = "SELECT * from patients where pID = $patientGuy";
    	 $result2 = mysqli_query($link , $query1);
        if (!$result2)
        {
            echo "not executed1";
            
        }    
        $pResult = mysqli_fetch_assoc($result2);
        $userName = $pResult["pname"];
       	$dig = $pResult["diagnosis"];
       	$ct = $pResult["casetype"];

       	 if(isset($_POST['done']))
        {
          
            $n = $_POST['p_names'];
           $sev = "1";
            $apD= $_POST['aD'];
            $d =  $_POST['dign']; 
            if( $_POST['v']==1)
              $sev = "Mild";
            else if ( $_POST['v']==2)
              $sev = "Moderate";
            else 
              $sev = "Severe"; 
          $insertQuery = "update patients set pname='$n' , diagnosis='$d', casetype='$sev' where pID='$patientGuy'";
         // $insertQuery = "update patients set pname = '$n'  where pID = '$patientGuy'";
          
             $result = mysqli_query($link , $insertQuery);
                if (!$result)
                {
                    echo "not executed1";
                }
                
                 $insertQuery2 = "update appointments set apDate='$apD'  where aID= '$get_id'";

                $result = mysqli_query($link , $insertQuery2);
                if (!$result)
                {
                    echo "not executed3";
                }
                
                header("Location: dummy.php");
   		}
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    <style type="text/css">
    	
.formclass {
   
    margin: auto;
    width: 50%;
    border: 3px solid lavender;
    margin-top: 10px;
}

.formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff  ;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 25px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}
    </style>
</head>

</head>
<body>
	<center> <div>
		<div  class="formclass formContent">
        <form  id="form" method="post">
       <h1> <center > Edit Data </center> </h1>
        <div class="wrap-input100" >
                    <span class="label-input100" > <h4>Username </h4> </span>
                     <input class="input100" type="text" name = "p_names"  id="username" value="<?php echo $userName; ?>" required="required">
                    <span class="focus-input100">
        </div>
        <div class="wrap-input100" >
                    <span class="label-input100" > <h4>Diagnosis </h4> </span>
                      <textarea class="input100" id="txtArea" rows="2"   name = "dign" required="required"> <?php echo $dig; ?>  </textarea><br>
         			<span class="focus-input100"></span>
        </div>
        <div>
   		<span class="label-input100" > <h4>Appointment Date </h4> </span> <br>
         <input type="date" id="aD" name="aD"><br><span class="focus-input100"></span>
		</div>
		         <span class="label-input100" > <h4>Severity </h4> </span>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary active">
              <input type="radio" name="v" id="1" value ="1" checked> Mild
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="v" id="2"  value ="2"> Moderate
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="v" id="3"  value ="3"> Severe
            </label>
          </div>
    		<br><br>	
            <button type="submit" class="btn btn-primary"  name="done"  >Done</button><br>
   		</form>
   		</div>

	</center></div>
   
  

</body>
</html>

