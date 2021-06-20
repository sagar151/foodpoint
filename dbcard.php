<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();
include_once 'product-action.php'; //including controller
// include_once 'header.php';
$user_id = $_SESSION["user_id"];

$dishes = "select * from dishes";
function test()
{
    echo "test";
}
function rate($a){
    $stars = $a;
    $count = 1;
    $result = "";
    for($i = 1; $i <= 5; $i++){
        if($stars >= $count){
            $result .= "<span>&#x2605</span>";
        } else {
            $result .= "<span>&#x2606</span>";
        }
        $count++;
    }
    echo $result;
}
if(!empty($_POST["name"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM dishes WHERE food_name LIKE '%".$_POST['name']."%'";
    // $query = "SELECT * FROM dishes"; 
    $result = $db->query($query); 
    //  echo $query;
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        // print_r($query); 
        while($row = $result->fetch_assoc()){  
            ?>
              <div class="card" style="width: 300px;margin-left: 10px;">
                            <form action="<?php echo $btn; ?>" method="POST" name="<?php echo $row['d_id']; ?>">
                            <img src="admin/Res_img/dishes/<?php echo $row['img']; ?>" alt="Strawberry" class="img-fruit" style="height: 200px;" />
                            <h3><?php echo $row['food_name']; ?></h3>
                            <p><?php echo $row['slogan']; ?></p>
                            <div class="rate" style="font-size:xx-large;"><?php rate($row['rate']); ?></div>
                            <div class="properties">
                                <div class="qty">
                                    <h4>Quantity</h4>
                                    <input type="number" name="quantity" value="1" id="<?php echo $row['d_id'].$row['d_id'].$row['d_id']; ?>" min="1" style="width: 70px;" />
                                </div>
                                <div class="price">
                                    <h4>Price</h4>
                                    <span class="price-inr">
                                    <i class="fa fa-inr"></i>
                                    <span class="amount"  id="<?php echo $row['d_id'].$row['d_id']; ?>"><?php echo $row['price']; ?></span>
                                </span>
                                </div>
                                <div class="delivery">
                                    <h4>Delivery</h4>
                                    <i class="fa fa-fighter-jet"></i>
                                    <span class="time">In 60 mins</span>
                                </div>
                            </div>
                            <input type="hidden" name="button1"></input>
                            <input type="button" onclick="addqty(this.id);" value="Total Price : <?php echo $row['price']; ?> Add to cart" id="<?php echo $row['d_id']; ?>" class="btn btn-primary"/>
                            </form>
                            </div>
            <?php  
        } 
    }else{ 
        echo '<option value="">Please enter valid dish name</option>'; 
    } 
}else
{
    echo "if else";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/card.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
<script>
function addqty(id){
    newid = id+id+id;

    qty = document.getElementById(newid).value;
    console.log(id,qty);
    $.ajax({
                type:'POST',
                url:'newproaction.php',
                data: {id:id,qty:qty},
                success:function(html){
                    $("#cartlink").load(location.href+" #cartlink >*","");
                }
            }); 
}
</script>
</body>
</html>