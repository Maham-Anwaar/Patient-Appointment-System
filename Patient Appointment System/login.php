<?php 
   require "index.php";
    $passwordErr = $emailErr = $websiteErr = "";
    $password = $email = "";
    $email_check=1;
    $error = 0;

    if (isset($_POST['log_in']))
    {
          if (empty($_POST["password"]))
           {
                $passwordErr = "Password is required";
                 $error = 1;
            } 
            else 
            {
                $password = ($_POST["password"]);
                if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/",$password))
                 {
                    $passwordErr = "Password must have one of each (Capital Letter,Small Letter and Digit)";
                     $error = 1;
                }
            }
        if (empty($_POST["email"])) 
        {
                $emailErr = "Email is required";
                 $error = 1;
        } 
        else
         {
            $email = ($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $emailErr = "Invalid email format";
                     $error = 1;
                }
        }
        $link = mysqli_connect("localhost", "root", "", "db1");

        if($link === false)
        {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        else
        {
            if($error==0)
            {
                $temp = $_POST["email"];
                $sql = "SELECT * FROM doctors where email='$temp' ";
                
                if($result = mysqli_query($link, $sql))
                {
                     $r = mysqli_fetch_assoc($result);
                    if($r["password"]==$_POST["password"])
                    {
                        $_SESSION['userinfo']['dID'] = $r["docID"];
                        $_SESSION['userinfo']['name'] = $r["username"];
                        $_SESSION['userinfo']['email'] = $_POST["email"];
                        $_SESSION['userinfo']['pass'] = $_POST["password"];
                        $_SESSION['userinfo']['casetype'] = "Mild"; 
                       
                        header('Location: index.php');
                    }
                    else
                    { 
                        $passwordErr="Password is wrong!!!"; 
                    }
                }         
                else
                { 
                    $emailErr = "Invalid email format";
                }
        }
            mysqli_close($link);
        }
    }
?>  

<!DOCTYPE html>
<html>
<head>
  
    <title>Login</title>
       
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
        <form  id="form" method="post">
       <h1> <center > Login </center> </h1>
       <?php if(!empty($emailErr)): ?>
                    <div>
                            <span style="color:red;"><strong>Error!</strong> <?php echo $emailErr;?></span><br>
                    </div>
                    <?php endif; ?>
         <div class="wrap-input100" >
                    <span class="label-input100" > <h3>Email </h3> </span>
                     <input class="input100" type="text" name="email" placeholder="Enter Email">
                    <span class="focus-input100"></span>
                </div>

                <?php if(!empty($passwordErr)): ?>
                  <div>
                    <span style="color: red;"><strong>Error!</strong> <?php echo $passwordErr;?></span>
                  </div>
                  <?php endif; ?>


                 <div class="wrap-input100" >   
                    <span class="label-input100" ><h3>Password </h3></span> 
                    <input class="input100" type="password" name="password" placeholder="Enter Password">
                    <span class="focus-input100"></span>

                </div>
                 <center><a href="index.php"><button class="contact100-form-btn" name="log_in">
                        <span>
                            Login
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button></a></center>
              
       </form>  
    </div>


</div>


</body>
