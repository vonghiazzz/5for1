<?php
   include_once 'header.php';
   $c = new Connect();
   $dblink = $c->connectToMySQL();

//    $sql ="SELECT MAX(oid) FROM user_order";
//         $re2 = $dblink->query($sql);
//        // $re3 = $re2->fetch(PDO::FETCH_BOTH);

    if (isset($_GET['total'])!=0 && isset($_POST['btnConfirm'])) {
        $total = $_GET['total'];
        
        // Thực hiện chèn dữ liệu vào bảng user_order
    $query1 = "INSERT INTO user_order(user_id, sum, date) VALUE(?,?,CURDATE())";
    $stmt1 = $dblink->prepare($query1);
    $stmt1->execute(array($_SESSION['userid'], $total));

    // Truy vấn để lấy mã đơn hàng vừa chèn
    $sql = "SELECT MAX(oid) FROM user_order";
    $re2 = $dblink->query($sql);
    $re3 = $re2->fetch_assoc(PDO::FETCH_BOTH);

    // Thực hiện chèn dữ liệu vào bảng order_detail
    $query2 = "INSERT INTO order_detail(oid, pID, pQuantity) VALUE(?,?,?)";
    $stmt2 = $dblink->prepare($query2);
    // Dùng vòng lặp hoặc dữ liệu từ Cart.php để thêm các chi tiết đơn hàng
    // Ví dụ: $orderDetails = $_POST['orderDetails']; // Nếu bạn gửi dữ liệu từ Cart.php
    // Duyệt qua mảng $orderDetails và thêm từng chi tiết đơn hàng vào bảng order_detail
    foreach ($orderDetails as $orderDetail) {
        $stmt2->execute(array($re3[0], $orderDetail['pID'], $orderDetail['pQuantity']));
    }

    // Xóa các sản phẩm trong giỏ hàng (nếu cần)
    $query3 = "DELETE FROM cart WHERE user_id = ?";
    $stmt3 = $dblink->prepare($query3);
    $stmt3->execute(array($_SESSION['userid']));





        $sql4 = "SELECT * FROM `user_order` order by oid DESC LIMIT 1" ;
        $re4 = $dblink->query($sql);
        if($re4->num_rows>0):
            while($row = $re4->fetch_assoc()):
    
   


?>





<body>
    <div class="container pb-5">
                <h2>Bill:</h2>
                <form action="" id="form1" name="form1" method="post" class="needs-validation">

                <div class="row pb-3">
                        <label for="txtID" class="col-md-2 col-form-lable">User ID(*):</label>
                        <div class="col-md-10">
                            <input type="text" name="txtID" id="txtID" readonly required class="form-control"
                                placeholder="Enter category ID" value="<?=$row['user_id'];?>" readonly>
                            <!--id với for giống nhau để chuyển sang id được -->
                        </div>
                    </div>

                    <div class="row pb-3">
                        <label for="txtName" class="col-md-2 col-form-lable">Order ID(*):</label>
                        <div class="col-md-10">
                            <input type="text" name="txtName" id="txtName" readonly required class="form-control"
                                placeholder="Enter category Name" value="<?=$row['oid'];?>">
                            <!--id với for giống nhau để chuyển sang id được -->
                        </div>
                    </div>

                    <div class="row pb-3">
                        <label for="txtDes" class="col-md-2 col-form-lable">Total(*):</label>
                        <div class="col-md-10">
                            <input type="text" name="txtDes" id="txtDes" readonly required class="form-control"
                                 value="$<?=$total;?>    ">
                                
                            <!--id với for giống nhau để chuyển sang id được -->
                        </div>
                    </div>
               
                  

                <div class="row pb-3 ms-auto">
                    <div class="">
                      <button onclick="window.location.href='index.php'" class="btn btn-outline-primary" type="button">Ok</button>                    </div>
                    </div>
                </form>
    </div>
</body>



<?php
endwhile; 
else:
echo "Not Found";
endif;
    }
?>