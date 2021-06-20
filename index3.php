<?php
    include("connection/connect.php");  //include connection file
    $output='';
    error_reporting(0);  // using to hide undefine undex errors
    session_start(); //start temp session until logout/browser closed
    $name2= $_SESSION["user_name"];
    $query_res="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Food Point</title>
    <!-- Bootstrap core CSS -->
    <link href="css/dishtable.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/indexcss.css">
    <link rel="stylesheet" href="js/jquery-3.6.0.min.js">
    <link rel="stylesheet" href="js/jquery-3.6.0.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
</head>

<body class="home">

sdfg
<form class="form-inline" method="post" name="form1" id="idform">
                            <div class="form-group">
                                <script>
                                    console.log("loaded");
                                </script>
                                <label class="sr-only" for="exampleInputAmount">I would like to eat....</label>
                                <div class="form-group">
                                <input type="text" name="foodsearch" class="form-control form-control-lg" id="searchid" placeholder="I would like to eat...."> 
                                </div>
                            </div>
                            <input type="button" name="button1" class="btn theme-btn btn-lg" id="btnsubmit" value="Search" ></input>
                        </form>
        <!-- Popular block starts -->
        <section class="popular">
            <br><br><br>
            <form class="form-inline" method="post" name="form1" id="idform" target="blank">
                            <div class="form-group">
                                <script>
                                console.log("loaded");
                                </script>
                                <label class="sr-only" for="exampleInputAmount">I would like to eat....</label>
                                <div class="form-group">
                                    <input type="text" name="foodsearch" class="form-control form-control-lg"
                                        id="searchid" placeholder="I would like to eat....">
                                </div>
                            </div>
                            <input type="submit" name="button1" class="btn theme-btn btn-lg" value="Search"></input>
                        </form>
            <br>
            <?php
                    if(array_key_exists('button1', $_POST)) {
                        button1($db);
                    }
                    function button1($db) {
                        ?>
            <table id="myTable">
                <tbody>
                    <?php
                                    echo "alert('asdf')";
                                    $nsearch = $_POST['foodsearch'];
                                    $nsearch = mysqli_real_escape_string($db,$nsearch);
                                 //   $query_res= mysqli_query($db,"select * from dishes"); 
                                    $query_res= mysqli_query($db,"select * from dishes WHERE food_name LIKE '%".$nsearch."%'"); 
                                    while($r=mysqli_fetch_array($query_res))
                                    {	
                                        echo '<div class="col-sm-3" style="margin: auto;height: 450px;">
                                        <div class="card" style="margin: auto; height: 90%;">
                                          <img src="admin/Res_img/dishes/'.$r['img'].'" class="card-img-top" alt="..." style="height: 200px;">
                                          <div class="card-body">
                                            <h5 class="card-title">'.$r['food_name'].'</h5>
                                            <p class="card-text">'.$r['slogan'].'</p>
                                            <p class="card-text" style="font-weight:bold">₹'.$r['price'].'</p>
                                            <a href="dishes.php?res_id='.$r['rs_id'].'" class="btn btn-primary">Add to cart</a>
                                          </div>
                                        </div>
                                      </div>';
                                    }
                                ?>
                </tbody>
            </table>
            <?php
                    }
                    ?>
        </section>
        <script>
          $("#searchbtn").click(function(){
            str = $("$searchid").val();
            console.log(str);
          })
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                crossorigin="anonymous"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>

</body>

</html>