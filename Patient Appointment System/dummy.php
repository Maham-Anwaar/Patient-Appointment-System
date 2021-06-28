<!--
1. Can only be viewed if the user is logged in
2. List will populate accordint to the doctors Id
3. The Modal code shall only show up when the add patient button is clicked. 

 -->

<?php

              require "index.php";

    $link = mysqli_connect("localhost", "root", "", "db1");
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        if(isset($_POST['insert']))
        {
          $x =  $_SESSION['userinfo']['dID'] ;
            $n = $_POST['p_names'];
           $sev = "1";
            $apD= $_POST['aD'];
            $d =  $_POST['dig']; 
            if( $_POST['v']==1)
              $sev = "Mild";
            else if ( $_POST['v']==2)
              $sev = "Moderate";
            else 
              $sev = "Severe";
           
            $insertQuery = "insert into patients(pname, diagnosis, casetype) values('$n', '$d', '$sev')";
             $result = mysqli_query($link , $insertQuery);
                if (!$result)
                {
                    echo "not executed1";
                }
                else
                {
                   $last_id = mysqli_insert_id($link);
                    $insertQuery2 = "insert into appointments(apDate,d_ID, p_ID) values('$apD', '$x', '$last_id')";

                    $result = mysqli_query($link , $insertQuery2);
                    if (!$result)
                    {
                        echo "not executed3";
                    }

                }   

        }
        

        
        
 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home </title>
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>


<body >
<div >
    <div>

  </div>
      <div class="container">
      <h1> Hello Doctor ! </h1>
      <p>Here's a list of your patients...</p>
      <button type="button" class="btn btn-primary" style=" float: right;"  data-toggle="modal" data-target="#myModal">Add Patients</button><br>

<!-- Modal For adding patients-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            
         <center> <h4 class="modal-title">Add Patients</h4> </center>
        </div>
        <div class="modal-body"> 
          <form  id="form" method="post" >
         <!-- insert form here -->
         <p> Patient Name </p>
          <input type="text" class="form-control" name = "p_names" ><br>
         <p> Diagnosis </p>
          <textarea class="form-control" id="txtArea" rows="3" name = "dig"></textarea><br>
         <p> Appoinment Date </p>

         <input type="date" id="aD" name="aD"><br>
         <p> Severity </p>
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

        </div>
        <div class="modal-footer">
              <button type="submit" class="btn btn-primary" style=" float: left;" name="insert"  >Insert</button><br>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>

       <div>    
        <?php $mild ="1"; $mod="2" ; $severe = "3";
          echo " <a href=".'work.php?id='.$mild.''.">";
          echo "MILD";
          echo '</a>';

          echo " <a href=".'work.php?id='.$mod.''.">";
          echo "MODERATE";
          echo '</a>';
            
          echo " <a href=".'work.php?id='.$severe.''.">";
          echo "SEVERE";
          echo '</a>';              
                              

          ?>
      </div>
        <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Patient Name</th>
                      <th scope="col">Diagnosis</th>
                      <th scope="col">Appoinmtent Date</th>
                    </tr>
                  </thead>
                    <tbody align="center">
                       <?php
                       $x =  $_SESSION['userinfo']['dID'] ;
                      $get_pro = "SELECT * from appointments where d_ID = '".$x."'";
                      $run_pro = mysqli_query($link,$get_pro);
                      $count_pro = mysqli_num_rows($run_pro);
                      if($count_pro==0)
                      {
                          echo "<h2> Nobody found in selected criteria </h2>";
                      }
                      else {
                          
                          $i = 1;
                          while ($row_pro = mysqli_fetch_array($run_pro)) {
                              $a_id = $row_pro['aID'];
                              $p_id = $row_pro['p_ID'];
                              $d_id = $row_pro['d_ID'];
                              $appD = $row_pro['apDate'];
                              $caseT = $_SESSION['userinfo']['casetype'] ;
                              if($d_id ==  $_SESSION['userinfo']['dID'] )
                              {
                                
                                $query = "SELECT * from patients where pID = '$p_id' and casetype='$caseT'";
                                $run = mysqli_query($link,$query);
                                $count = mysqli_num_rows($run);

                                if($count > 0)
                                {
                                   while ($row = mysqli_fetch_array($run)) 
                                   {
                                      $pname =  $row['pname'];
                                       $dig =  $row['diagnosis'];
                                       echo "<tr>";
                                       echo "<th style = ".'color:black;font-family: monospace;'." scope=".'row'." width='200' height='80'> $i </th>";
                              echo "<th style = ".'color:black;font-family: monospace;'." scope=".'row'." width='200' height='80'> $pname </th>";
                              echo "<th style = ".'color:black;font-family: monospace;'." scope=".'row'." width='200' height='80'> $dig </th>";
                              echo "<th style = ".'color:black;font-family: monospace;'." scope=".'row'." width='200' height='80'>$appD </th>";

                              
                               echo "<th> <a href=".'trash.php?id='.$p_id.''.">";
                              echo '<span class="glyphicon glyphicon-trash"></span>';
                              echo '</a>';
                              echo "</th>"; 
                              
                             
                              echo "<th> <a href=".'edit.php?id='.$a_id.''.">";
                              echo '<span class="glyphicon glyphicon-edit"></span>';
                              echo '</a>';
                              echo "</th>"; 
                                echo "</tr>";
                                   }
                                   $i++;
                                }
                              }
                          }
                      }
                      ?></tbody>


        </table> 
 </div>
  </div>
</div> 
</body>
</html>



   