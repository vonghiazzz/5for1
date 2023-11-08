<?php
include_once 'header.php';
//if(isset($_SESSION['user'])){
//  $user = $_SESSION['user'];
$c = new Connect();
$dblink = $c->connectToPDO(); 
// if(isset($_COOKIE['cc_username'])){ //check if user logged into website
//     $user = $_COOKIE['cc_username'];
//     $user_id = $_COOKIE['cc_id'];
// if (isset($_GET['btnConfirm'])) {
    if (isset($_SESSION['user_name'])) { //check if user logged into website
        $user = $_SESSION['user_name'];
        $user_id = $_SESSION['userid'];
        $sum = 0;
        $b = 0;
        $p_ID = 0;
        isset($_GET['$sum']);
        isset($_GET['$b']);
        isset($p_ID);
        // echo "echo<br>";

        if (isset($_GET['pID'])) { // when user add an item to shopping cart
            $p_ID = $_GET['pID'];
            $sqlSelect1 = "SELECT pID FROM cart WHERE user_id=? AND pID=?";
            $re = $dblink->prepare($sqlSelect1);
            $re->execute(array("$user_id", "$p_ID"));


            // $stmt->fetch(PDO::FETCH_ASSOC);

            //check if the item has been added
            if ($re->rowCount() == 0) { //The item could not be found in user's cart
                $query = "INSERT INTO cart(user_id, pID, pCount, date) VALUE(?,?,1,CURDATE())";
            } else { //Added by user
                $query = "UPDATE cart SET pCount = pCount + 1 WHERE user_id=? AND pID=?";
            }



            $stmt = $dblink->prepare($query);
            $stmt->execute(array("$user_id", "$p_ID"));


        } else if (isset($_GET['del_id'])) { //when user want to delete an item to shopping cart
            $cart_del = $_GET['del_id'];
            $query = "DELETE FROM cart WHERE cart_id=?";
            $stmt = $dblink->prepare($query);
            $stmt->execute(array($cart_del));
        }


        //Show a list of shopping cart
        $sqlSelect = "SELECT * FROM cart c, product p WHERE c.pID= p.pID AND user_id=?";
        $stmt1 = $dblink->prepare($sqlSelect);
        $stmt1->execute(array($user_id));
        $rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
    } else {
        header("Location: login.php");
    }

?>

<div class="container">
    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
    <h6 class="mb-0 text-muted"><?= $stmt1->rowCount() ?> item(s)</h6>
    <table class="table">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php

    foreach ($rows as $row) {

        ?>

        <tr>
            <td><?= $row['pName'] ?></td>
            <td> <input id="form1" min="0" name="quantity" value="<?= $row['pCount'] ?>" type="number"
                    class="form-control form-control-sm" /></td>
            <td>
                <h6 class="mb-0"><?= $row['pCount'] ?> *<span class=" bi bi-currency-dollar"><?= $row['pPrice'] ?></span>
                </h6>
            </td>
            <td><a href="cart.php?del_id=<?= $row['cart_id'] ?>" class="text-muted text-decoration-none">x</a></td>
        </tr>
     
     
<?php
        $total = $row['pCount'] * $row['pPrice'];
        $sum = $sum + $total;
        $b = $b+ $row['pCount'];
        

    }
    
    $query1 = "INSERT INTO user_order(user_id, sum, date) VALUE(?,?,CURDATE())";
    $stmt1 = $dblink->prepare($query1);
    $stmt1->execute(array("$user_id", "$sum"));

    $sql ="SELECT MAX(oid) FROM user_order";
    $re2 = $dblink->query($sql);
    $re3 = $re2->fetch(PDO::FETCH_BOTH);
        // echo array_sum($a);
       // echo $re3[0];


    $query1 = "INSERT INTO order_detail(oid, pID, pQuantity) VALUE(?,?,?)"; 
    $stmt1 = $dblink->prepare($query1);
    $stmt1->execute(array($re3[0], "$p_ID",$b));
?>

    </table>
    <hr class="my-4">
    <form action="" method="get" class="needs-validation">
        <div class="col-md-12 d-flex justify-content-end ">
            <p><b>Total: <?php echo $sum; ?><span class=" bi bi-currency-dollar"></span></b></p>
        </div>
        <div class="container d-inline-flex justify-content-between">
            <div class="">
                <div class="fas fa-long-arrow-alt-left me-2">
                    <button onclick="window.location.href='index.php'" type="button" class="btn btn-black">
                        Back to Shop</button>
                </div>
            </div>
            <div class="">
                <div class="fas fa-long-arrow-alt-right me-2">
                    <button onclick="window.location.href='confirm.php'" type="button" class="btn btn-black" name="btnConfirm"
                        id="btnConfirm">
                        Confirm</button>
                </div>
            </div>
        </div>
    </form>
<?php
// }
//          else{
//              echo "error";
//          }

?>