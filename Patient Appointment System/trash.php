
<?php
if(isset($_GET['id'])){
	$link = mysqli_connect("localhost", "root", "", "db1");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $get_id = $_GET['id'];
    $delThis = "DELETE from appointments where p_ID = '$get_id'";
    $delThis = mysqli_query($link, $delThis);
    
    if (!$delThis)
    {
        echo "not executed";
    } 
    $delThis = "DELETE from patients where pID = '$get_id'";
    $delThis = mysqli_query($link, $delThis);
    if (!$delThis)
    {
        echo "not executed2";
    } 
    header("Location: dummy.php");
}
