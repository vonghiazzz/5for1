
<?php
include_once 'header.php';

// Tạo kết nối đến CSDL
$c = new Connect();
$dblink = $c->connectToPDO();

if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    $user_id = $_SESSION['userid'];
    $sum = 0;
    $b = 0;
    $p_ID = 0;

    if (isset($_GET['pID'])) {
        $p_ID = $_GET['pID'];
        $sqlSelect1 = "SELECT pID FROM cart WHERE user_id=? AND pID=?";
        $re = $dblink->prepare($sqlSelect1);
        $re->execute(array($user_id, $p_ID));

        if ($re->rowCount() == 0) {
            $query = "INSERT INTO cart(user_id, pID, pCount, date) VALUES (?,?,1,CURDATE())";
        } else {
            $query = "UPDATE cart SET pCount = pCount + 1 WHERE user_id=? AND pID=?";
        }

        $stmt = $dblink->prepare($query);
        $stmt->execute(array($user_id, $p_ID));
    } elseif (isset($_GET['del_id'])) {
        $cart_del = $_GET['del_id'];
        $query = "DELETE FROM cart WHERE cart_id=?";
        $stmt = $dblink->prepare($query);
        $stmt->execute(array($cart_del));
    }
  
    // Lấy danh sách sản phẩm trong giỏ hàng
    $sqlSelect = "SELECT * FROM cart c, product p WHERE c.pID = p.pID AND user_id=?";
    $stmt1 = $dblink->prepare($sqlSelect);
    $stmt1->execute(array($user_id));
    $rows = $stmt1->fetchAll(PDO::FETCH_BOTH);
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
        $b = $b + $row['pCount'];
    }
    $query1 = "INSERT INTO user_order(user_id, sum, date) VALUE(?,?,CURDATE())";
    $stmt1 = $dblink->prepare($query1);
    $stmt1->execute(array($_SESSION['userid'], $total));

    // Truy vấn để lấy mã đơn hàng vừa chèn
    $sql = "SELECT MAX(oid) FROM user_order";
    $re2 = $dblink->query($sql);
    $re3 = $re2->fetch(PDO::FETCH_BOTH);

    // Thực hiện chèn dữ liệu vào bảng order_detail
   
   
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
                <button onclick="window.location.href='confirm.php?sum=<?php echo $sum; ?>'" type="button" class="btn btn-black" name="btnConfirm" id="btnConfirm">
                    Confirm
                </button>
                <?= $sum?>
                </div>
            </div>
        </div>
    </form>
    </div>
<?php
} else {
    header("Location: login.php");
}
?>
