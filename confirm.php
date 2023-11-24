<?php
include_once 'header.php';
$c = new Connect();
$dblink = $c->connectToPDO();
   
if (isset($_GET['sum'])) {
    $user_id = $_SESSION['userid'];
    $total =$_GET['sum'];
  
    


    // $query = "SELECT * FROM `cart` WHERE user_id = ?";
    // $stmt4 = $dblink->prepare($query);
    // $stmt4 -> execute(array($user_id));
    // while($cartItem = $stmt4->fetch(PDO::FETCH_ASSOC)){
    //     $query1 = "INSERT INTO user_order(user_id,pID, quantity ) VALUE(?,?,?)";
    //     $stmt1 = $dblink->prepare($query1);  
    //     $stmt1->execute(array($_SESSION['userid'],$cartItem['pID'],$cartItem['pCount']));
    // }
    
   

    // $query5 = "SELECT * FROM `user_order` WHERE user_id = ?";
    // $stmt5 = $dblink->prepare($query5);
    // $stmt5->execute(array($user_id)); // Thực thi truy vấn với tham số

    // while($cartItems = $stmt4->fetch(PDO::FETCH_ASSOC)){
    //     $productQuery = "SELECT * FROM `product` WHERE pID = ?";
    //     $productStmt = $dblink->prepare($productQuery);
    //     $productStmt->execute(array($cartItem['pID']));
    //     $productInfo = $productStmt->fetch(PDO::FETCH_ASSOC);

    //     $totalPrice = $productInfo['pPrice'] * $cartItem['pQuantity'];
       
    //     $query5 = "SELECT * FROM `user_order` WHERE user_id = ?";
    //     $stmt5 = $dblink->prepare($query5);   
    //     $r5 = $stmt5->fetch(PDO::FETCH_BOTH);
    //     $stmt2 = $dblink->prepare("INSERT INTO order_detail(oid, pID, sum, date) VALUES (?, ?, ?, CURDATE())");
    //     $stmt2->execute(array($r5['oid'], $r5['pID'], $total));

    // }


    $query = "SELECT * FROM `cart` WHERE user_id = ?";
    $stmt4 = $dblink->prepare($query);
    $stmt4->execute(array($user_id));

   
    
    while ($cartItem = $stmt4->fetch(PDO::FETCH_ASSOC)) {     
        $query1 = "INSERT INTO user_order(user_id, pID, quantity) VALUES (?, ?, ?)";
        $stmt1 = $dblink->prepare($query1);  
        $stmt1->execute(array($_SESSION['userid'], $cartItem['pID'], $cartItem['pCount']));
    
        // Tìm thông tin sản phẩm từ bảng product
        $productQuery = "SELECT * FROM `product` WHERE pID = ?";
        $productStmt = $dblink->prepare($productQuery);
        $productStmt->execute(array($cartItem['pID']));
        $productInfo = $productStmt->fetch(PDO::FETCH_ASSOC);
    
        // Tính tổng giá trị của sản phẩm và thêm vào order_detail
        $totalPrice = $productInfo['pPrice'] * $cartItem['pCount'];
    
        $query5 = "SELECT * FROM `user_order` WHERE user_id = ? ORDER BY oid DESC LIMIT 1";
        $stmt5 = $dblink->prepare($query5);
        $stmt5->execute(array($user_id));
        $r5 = $stmt5->fetch(PDO::FETCH_ASSOC);
    
        $stmt2 = $dblink->prepare("INSERT INTO order_detail(oid, pID, sum, date) VALUES (?, ?, ?, CURDATE())");
        $stmt2->execute(array($r5['oid'], $cartItem['pID'], $totalPrice));
    }
    





    // // Dùng fetch để lấy từng hàng một
    // while ($r5 = $stmt5->fetch(PDO::FETCH_BOTH)) {
    //     $stmt2 = $dblink->prepare("INSERT INTO order_detail(oid, pID, sum, date) VALUES (?, ?, ?, CURDATE())");
    //     $stmt2->execute(array($r5['oid'], $r5['pID'], $total));
    // }

    // Truy vấn để lấy mã đơn hàng vừa chèn
    // $sql = "SELECT MAX(oid) FROM user_order";
    // $re2 = $dblink->query($sql);
    // $re3 = $re2->fetch_all(PDO::FETCH_BOTH);


    // $sql = "SELECT MAX(oid) FROM user_order";
    // $re2 = $dblink->query($sql);
    // $re3 = $re2->fetch_column();

    // $sql1 = "SELECT * FROM
    // category b, product a WHERE a.pCat_id = b.pCat_id and pId=?";
    // $stmt1 = $dblink->prepare($sql1);
    // $stmt1->execute(array("$pID"));
    // $re1 = $stmt1->fetch(PDO::FETCH_BOTH);


    // $query5 = "SELECT * FROM `user_order` WHERE user_id = ?";
    // $stmt5 = $dblink->prepare($query5);   
   
    // $re5 = $stmt5->fetchAll(PDO::FETCH_BOTH);

    
    // $query2 = "INSERT INTO order_detail(oid, pID, sum,date) VALUE(?,?,?,CURDATE())";
    // $stmt2 = $dblink->prepare($query2);
    // // Dùng vòng lặp hoặc dữ liệu từ Cart.php để thêm các chi tiết đơn hàng
    // // Ví dụ: $orderDetails = $_POST['orderDetails']; // Nếu bạn gửi dữ liệu từ Cart.php
    // // Duyệt qua mảng $orderDetails và thêm từng chi tiết đơn hàng vào bảng order_detail
    // foreach ($re5 as $r5) {
    //     $stmt2->execute(array($r5['oid'], $r5['pID'], $total));
    // }





    // Xóa các sản phẩm trong giỏ hàng (nếu cần)
    $query3 = "DELETE FROM cart WHERE user_id = ?";
    $stmt3 = $dblink->prepare($query3);
    $stmt3->execute(array($_SESSION['userid']));
    
}

$sql4 = "SELECT * FROM `user_order` order by oid DESC LIMIT 1";
$re4 = $dblink->query($sql4);
if ($re4->rowCount() > 0):
    while ($row = $re4->fetch(PDO::FETCH_ASSOC)):
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <!-- Thêm các thẻ meta, CSS, và JS cần thiết cho trang này -->
</head>
<body>
    <div class="container pb-5">
        <h2>Bill:</h2>
        <form action="" id="form1" name="form1" method="post" class="needs-validation">
            <div class="row pb-3">
                <label for="txtID" class="col-md-2 col-form-lable">User ID(*):</label>
                <div class="col-md-10">
                    <input type="text" name="txtID" id="txtID" readonly required class="form-control"
                        placeholder="Enter category ID" value="<?= $row['user_id']; ?>" readonly>
                </div>
            </div>

            <!-- <div class="row pb-3">
                <label for="txtName" class="col-md-2 col-form-lable">Order ID(*):</label>
                <div class="col-md-10">
                    <input type="text" name="txtName" id="txtName" readonly required class="form-control"
                        placeholder="Enter category Name" value="<?= $row['oid']; ?>">
                </div>
            </div> -->

            <div class="row pb-3">
                <label for="txtDes" class="col-md-2 col-form-lable">Total(*):</label>
                <div class="col-md-10">
                    <input type="text" name="txtDes" id="txtDes" readonly required class="form-control"
                        value="$<?= $total; ?>">
                </div>
            </div>

            <div class="row pb-3 ms-auto">
                <div class="">
                    <button onclick="window.location.href='index.php'" class="btn btn-outline-primary" type="button">Ok</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    endwhile;
else:
    echo "Not Found";
endif;
?>