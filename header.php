<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5For1</title>
  <link rel="icon" href="./images/Logo.jpg" type="">
  <link rel="stylesheet" type="text/css" href="./ASM.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
    integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link type="text/css" rel="stylesheet" href="./CSS/bootstrap.min.css"/> -->
    <!-- <link type="text/css" rel="stylesheet" href="./CSS/font-awesome.min.css"/> -->
    <link type="text/css" rel="stylesheet" href="./CSS/nouislider.min.css"/>
    <link type="text/css" rel="stylesheet" href="./CSS/slick-theme.css"/>
    <link type="text/css" rel="stylesheet" href="./CSS/slick.css"/>
    <link type="text/css" rel="stylesheet" href="./CSS/style.css"/>
</head>

<body>
  <header class="navbar navbar-expand-md navbar-white bg-white ">
    <!--Nar là thẻ điều hướng, expand là mức độ mở rộng khi đạt kích thước midle -->
    <div class="container-fluid border-bottom">
      <img src="./images/Logo.jpg" width="120px" height="80px">
      <a href="index.php" class="navbar-brand" id="Logo">5For1</a>

      <form>
        <?php
          if(isset($_SESSION['user_name'])):
            
          // if(isset($_COOKIE['cc_username'])):
        ?>
        <!-- <button onclick="confirmBox()" class="btn btn-outline-secondary"
          type="button">Welcome,<?=$_COOKIE['cc_username']?></button> -->
        <button onclick="confirmBox()" class="btn btn-outline-secondary" type="button">Xin
          chào,<?=$_SESSION['user_name']?></button>
        <button onclick="window.location.href='logout.php'" class="btn btn-outline-secondary" type="button">Đăng
          xuất</button>
        <?php
          else:
        ?>
        <button onclick="window.location.href='login.php'" class="btn btn-outline-secondary" type="button">Đăng
          nhập</button>
        <button onclick="window.location.href='registration.php'" class="btn btn-outline-secondary" type="button">Đăng
          ký</button>
        <?php
         endif;
        ?>
      </form>
    </div>

  </header>
  <nav class="navbar navbar-expand-md navbar-white bg-dark px-1 ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <!--data-bs-target để tên của thẻ cần sổ,toggler là sổ xuống, -->
      <span class="navbar-toggler-icon"></span> <!-- Hiện nút ba gạch cho việc sổ xuống -->
    </button>
    <div class="collapse navbar-collapse col-md-8" id="navbarMain">
      <div class="navbar-nav">
        <a class="nav-link active text-light" onclick="window.location.href='index.php'" href="#">Trang chủ</a>
        <a class="nav-link text-light" href="cart.php" ><i class="bi bi-cart-fill"></i></a>


        <!-- <div class="dropdown">
          <a href="#" class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown">Manage</a> -->
        <!--dropdown để sổ r sổ tiếp -->
        <!-- <div class="dropdown-menu bg-black text-light">
            <div class="row">
              <a class="dropdown-item text-light" href="#">Product</a>
              <a class="dropdown-item text-light" href="#">Account</a>
              <a class="dropdown-item text-light"  href="#">Order</a>
            </div>
          </div>
        </div> -->


        <?php
include_once 'connect.php';
$c = new Connect();
$dblink = $c->connectToMySQL();
$sql = "SELECT parentCat FROM category c JOIN product p WHERE c.pCat_id=p.pCat_id GROUP BY parentCat";
$re1 = $dblink->query($sql);
$re1->data_seek(0);
 if($re1->num_rows>0):
   while($row1= $re1->fetch_row()):                
?>
        <div class="dropdown">
          <a href="#" class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown"><?=$row1[0]?></a>
          <!--dropdown để sổ r sổ tiếp -->
          <div class="dropdown-menu bg-black">
            <?php

//$sql = "SELECT * FROM category c join product p where c.pCat_id=p.pCat_id and parentCat='$row1[0]'";
    $sql = "SELECT * FROM category c join product p where c.pCat_id=p.pCat_id and parentCat='$row1[0]' GROUP BY catName";
$re = $dblink->query($sql);
while($row= $re->fetch_row()):
  // $re1 = $dblink->prepare($sql);
  // $re1-> execute(array());
    
?>

            <a class="dropdown-item text-light"
              href="search.php?search=<?=$row[1]?>&btnSearch=<?=$row[0]?>"><?=$row[1]?></a>


            <?php
endwhile;
?>
          </div>

        </div>
        <?php
endwhile; 
else:
echo "Not Found";
endif;

?>

        <!-- <div class="dropdown">
          <a href="#" class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown">Women's Fashion</a> -->
        <!--dropdown để sổ r sổ tiếp -->
        <!-- <div class="dropdown-menu bg-black"> -->
        <?php 
            // include_once('connect.php');
            // $c = new Connect();
            // $dblink = $c->connectToMySQL();
            // $sql = "SELECT * FROM category where parentCat='Womens Fashion'";
            // $re = $dblink->query($sql);
            // $categorys = array();
            // while($row= $re->fetch_row()):
            //   // $re1 = $dblink->prepare($sql);
            //   // $re1-> execute(array());
                
            ?>

        <!-- <a class="dropdown-item text-light" href="<?//echo $row[0]?>"><?//echo $row[2]?></a> -->

        <?php
          //  endwhile;
            ?>
        <!-- </div> -->

      </div>
    </div>
    </div>

    <div class="col-md-4">

      <form class="d-flex example1" action="search.php">
        <input class="form-control me-2" name="search" type="search" placeholder="Bạn muốn tìm kiếm gì?"
          aria-label="Search">
        <button class="btn btn-outline-success" name="btnSearch" type="submit">Tìm kiếm</button>
      </form>

    </div>
  </nav>