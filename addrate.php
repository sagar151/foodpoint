<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();
include_once 'product-action.php'; //including controller
$user_id = $_SESSION['user_id'];
$dishes = "select * from dishes";
$flag = true;
if(!isset($_SESSION['arr']))
{
    $_SESSION['arr'] = array();
}
if((!empty($_POST["foodname"]))&&(!empty($_POST["rating"])))
{  
    $foodname = $_POST["foodname"];
    $rating = $_POST["rating"];
    foreach($_SESSION['arr'] as $key=>$value)
    {
        if($key != $user_id.$foodname && $value != $foodname)
        {
            $flag = true;
        }
        else
        {
            $flag = false;
            goto out;            
        }
    }
    out:
    if($flag == true)
    {
        $newelement = array($user_id.$foodname => $foodname);
        $_SESSION['arr'] = $_SESSION['arr']+$newelement;
        $query = "select rate from dishes where food_name='$foodname'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $newrate = round(($rating+$row['rate'])/2);
        $addrate = "UPDATE dishes SET rate='$newrate' where food_name='$foodname'";
        if($db->query($addrate))
        {
            echo "Thank You!";
        }
    }
    else
    {
        echo "Already rated";
    }
}
else
{
    echo "if else";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
<script>

</script>
</body>
</html>