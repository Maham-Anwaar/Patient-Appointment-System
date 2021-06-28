<?php
 require "index.php";
$emailErr="";
$passErr="";

$link = mysqli_connect("localhost", "root", "", "db1");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());    
}

if (isset($_POST['sign_up'])) 
{
    $sql = "SELECT * FROM doctors";
    if($result = mysqli_query($link, $sql))
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                if($row["email"]==$_POST["email"])
                {
                    $emailErr= "Already have an account on this Email!!!";
                }
            }
        }
    }
    if(empty($emailErr))
    {
        $u_name = $_POST['username'];
        $email = $_POST['email'];
        $pass1 = $_POST['pass'];
        $pass2 = $_POST['cpass'];
        
        if($pass1 == $pass2)
        {
       
          $query = "INSERT INTO doctors (username,  email, password) 
          VALUES('$u_name',  '$email', '$pass1')";
          mysqli_query($link, $query);
          $_SESSION['userinfo']['name'] = $u_name;
          $_SESSION['userinfo']['email'] = $_POST["email"];
          $_SESSION['userinfo']['pass'] = $_POST["pass"];
          header('Location: index.php');
        }
        else
        {
           $passErr = "Password does not match!!!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  
    <title>Sign up</title>
   

   <style>
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

<body>

<!-- For the header otherwise all data gets added into the header -->
<div  class="formclass formContent">
        <form  method="post">
       <h1> <center > Sign up </center> </h1>
         <div class="wrap-input100" >
                    <span class="label-input100" > <h3>Username </h3> </span>
                     <input class="input100" type="text" name="username"  id="username" placeholder="Enter Username" required="required">
                    <span class="focus-input100"></span>
                </div>

                 <div class="wrap-input100" >
                    <span class="label-input100" ><h3>Email </h3></span> 
                    <input class="input100" type="email" name="email"  id="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" placeholder="Enter Email" required="required">
                    <span class="focus-input100"></span>

                    <?php if(!empty($emailErr)): ?>
                    <div>
                            <span style="color:red;"><strong>Error!</strong> <?php echo $emailErr;?></span>
                    </div>
                    <?php endif; ?>

                </div>
                 <div class="wrap-input100" >
                    <span class="label-input100" ><h3>Password </h3></span> 
                    <input class="input100" type="password" name="pass"  id="pass" placeholder="Enter Password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,}" title="Password Must Contain one of each (Capital Letter,Small Letter and Digit)">
                    <span class="focus-input100"></span>

                </div>
                 <div class="wrap-input100" > 
                    <span class="label-input100" ><h3>Confirm Password </h3></span> 
                    <input class="input100" type="password" name="cpass" id="cpass" placeholder="Re-enter password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,}" title="Password Must Contain one of each (Capital Letter,Small Letter and Digit)">
                    <span class="focus-input100"></span>

                </div>
                 <?php if(!empty($passErr)): ?>
                    <div>
                            <span style="color:red;"><strong>Error!</strong> <?php echo $passErr;?></span><br>
                    </div>
                    <?php endif; ?>

                    <center> <button class="contact100-form-btn" name="sign_up">
                  
                            Sign-Up
                            
                    </button> </center>    
       </form>  
    </div>
</div>
</body>
</html>