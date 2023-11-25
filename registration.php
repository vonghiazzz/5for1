<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5For1</title>
    <link rel="icon" href="./images/Logo.jpg" type="">
    <link rel="stylesheet" type="text/css" href="./ASM.css">
    <style>
        div.example {
            background-color: lightgray;
            padding: 20px;
        }

        @media screen and (min-width: 600px) {
            div.example {
                /* display:none; */
                background-color: aqua;
            }
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
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
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <!--Nar là thẻ điều hướng, expand là mức độ mở rộng khi đạt kích thước midle -->
        <div class="container-fluid">
            <img src="./images/Logo.jpg" width="120px" height="80px">
            <a href="#" class="navbar-brand" onclick="window.location.href='index.php'" id="Logo">5For1</a>

            <form>
                <button onclick="window.location.href='login.php'" class="btn btn-outline-secondary" type="button">Đăng
                    nhập</button>
            </form>
        </div>
    </nav>
    <?php
    //print_r($_POST);
    $error="";
    use LDAP\Result;
    if(isset($_POST['btnRegister'])){             // isset được dùng để xóa cảnh báo define 
        if( isset($_POST['email']) && isset($_POST['pass'])&& isset($_POST['repass'])
        && isset($_POST['phone'])&& isset($_POST['gender'])&& isset($_POST['address'])){
            $fullname = htmlspecialchars(trim($_POST['fullname']));
            // $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $pass = htmlspecialchars(trim($_POST['pass']));
            $repass = htmlspecialchars(trim($_POST['repass']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            $gender = htmlspecialchars(trim($_POST['gender']));
            $address = htmlspecialchars(trim($_POST['address']));
            $birth =date('Y-m-d',strtotime($_POST['txtBirth']));

            if(strlen($fullname)<6) {$error.= "<center>User name can not be less than 6 characters</center><br/>";}
            if(strlen($fullname)>30) {$error.= "<center>User name can not be greater than 30 characters</center><br/>";}

            // if(strlen($username)<6) {$error.= "<center>User name can not be less than 6 characters</center><br/>";}
            // if(strlen($username)>30) {$error.= "<center>User name can not be greater than 30 characters</center><br/>";}

            if(strlen($email)<6) {$error.= "<center>Email can not be less than 6 characters</center><br/>";}
            if(strlen($email)>30) {$error.= "<center>Email can not be greater than 30 characters</center><br/>";}

            if(strlen($pass)<10) {$error.= "<center>Password can not be less than 10 characters</center><br/>";}
            if(($repass)!=($pass)) {$error.= "<center>Confirmation password is not correct</center><br/>";}

            if(strlen($address)<6) {$error.= "<center>Address can not be less than 6 characters</center><br/>";}
            if(strlen($address)>30) {$error.= "<center>Address can not be greater than 30 characters</center><br/>";}

            if(strlen($phone)!= 10) {$error.= "<center>Phone must be 10 integer numbers</center><br/>";}
            if(strlen($birth)!=10) {$error.= "<center>Birthday can not be blank</center><br/>";}

            if(strlen($gender)==0) {$error.= "<center>Gender can not be blank</center><br/>";}
            // if(isset($country) === "Choose your country") {$error.= "<center>You have not selected a country</center><br/>";}
            

            if($error==""){
                include_once 'connect.php';
                $c = new Connect();
                $dblink = $c->connectToPDO();

                // Kiểm tra xem email đã tồn tại trong CSDL chưa
                $email = $_POST['email'];
                $sql_check = "SELECT COUNT(*) FROM `user` WHERE `email` = ?";
                $result_check = $dblink->prepare($sql_check);
                $result_check->execute([$email]);
                $count = $result_check->fetchColumn();

                if ($count == 0) {
                    // Nếu email chưa tồn tại, thực hiện INSERT
                    $sql = "INSERT INTO `user`(`email`, `fullname`, `gender`, `address`, `password`, `role`, `phone`, `birthday`) VALUES (?,?,?,?,?,?,?,?)";
                    $result = $dblink->prepare($sql);
                    $stm = $result->execute([$email, $fullname, $gender, $address, $pass, "user", $phone, $birth]);
                    if ($stm == true) {
                        echo "You have created an account successfully!";
                    } else {
                        echo "Insertion failed!";
                    }
                } else {
                    echo "<div class='alert alert-danger text-center'>Email has been used!</div>";
                }
                }
            }            
    }
    ?>

    <body>
        <div class="container ps-5 pe-5">
            <div class="row ps-5 pe-5">
                <h2>Đăng ký</h2>
            </div>

            <form action="" id="form1" name="form1" method="post" class="needs-validation">

                <div class="row pb-3 ps-5 pe-5">
                    <?php if($error!="") {?>
                    <div class="alert alert-danger"><?php echo $error?></div>
                    <?php } ?>
                </div>
                <div class="row pb-3 ps-5 pe-5">
                    <label for="fullname" class="col-md-2 col-form-lable">Họ và tên:</label>
                    <div class="col-md-10">
                        <input type="text" name="fullname" id="fullname" required class="form-control"
                            placeholder="Điền họ và tên" value="<?=isset($fullname)? $fullname:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row ps-5 pe-5 pb-3">
                    <label for="email" class="col-md-2 col-form-lable">Email:</label>
                    <div class="col-md-10">
                        <input type="text" name="email" id="email" required class="form-control"
                            placeholder="Điền email" value="<?=isset($email)? $email:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3 ps-5 pe-5">
                    <label for="pass" class="col-md-2 col-form-lable">Mật khẩu:</label>
                    <div class="col-md-10">
                        <input type="password" name="pass" id="pass" required class="form-control"
                            placeholder="Điền mật khẩu" value="<?=isset($pass)? $pass:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row ps-5 pe-5 pb-3">
                    <label for="repass" class="col-md-2 col-form-lable">Xác nhận mật khẩu:</label>
                    <div class="col-md-10">
                        <input type="password" name="repass" id="repass" required class="form-control"
                            placeholder="Xác nhận lại mật khẩu" value="<?=isset($repass)? $repass:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3 ps-5 pe-5">
                    <label for="phone" class="col-md-2 col-form-lable">Số điện thoại:</label>
                    <div class="col-md-10">
                        <input type="text" name="phone" id="phone" required class="form-control"
                            placeholder="Điền số điện thoại" value="<?=isset($phone)? $phone:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>

                <div class="row pb-3 ps-5 pe-5">
                    <label for="gender" class="col-md-2 col-form-lable">Giới tính:</label>
                    <div class="col-md-10 d-flex">
                        <div class="form-check pe-3 my-auto">
                            <input type="radio" name="gender" id="maleRd" class="form-check-input" value="1"
                                <?= isset($gender)==1?"checked":""?>>
                            <!--id với for giống nhau để chuyển sang id được -->
                            <label for="maleRd" class="form-check-label">Nam</label>
                        </div>

                        <div class="form-check my-auto">
                            <input type="radio" name="gender" id="femaleRd" class="form-check-input" value="0"
                                <?= isset($gender)==0?"checked":""?>>
                            <!--id với for giống nhau để chuyển sang id được -->
                            <label for="femaleRd" class="form-check-label">Nữ</label>
                        </div>

                    </div>

                </div>
                <!-- <div class="row pb-3">
                    <label for="country" class="col-md-2 col-form-lable">Country:</label>
                    <div class="col-md-10">
                        <select id="country" class="form-select" name="country"
                            value="<?php //echo isset($country)? $country:""?>">
                            <option selected>Choose your country</option>
                            <option>Viet Nam</option>
                            <option>American</option>
                        </select>
                    </div>
                </div> -->
                <?php
                    //$date = isset($_POST['txtBirth']);
                    //echo $date;
                    //$formatedDate = date('d-m-Y', strtotime($date));
                    //echo $formatedDate;
                ?>
                <div class="row pb-3 ps-5 pe-5">
                    <label for="birthday" class="col-md-2 col-form-lable">Ngày sinh:</label>
                    <div class="col-md-10">
                        <input type="date" name="txtBirth" id="txtBirth" value="<?= $_POST??""?>" required
                            class="form-control" value="<?=  $formatedDate?? "";?>"
                            value="<?=isset($birthday)? $birthday:""?>" />
                    </div>
                </div>
                <div class="row pb-3 ps-5 pe-5">
                    <label for="address" class="col-md-2 col-form-lable">Địa chỉ:</label>
                    <div class="col-md-10">
                        <input type="text" name="address" id="address" required class="form-control"
                            placeholder="Điền địa chỉ" value="<?=isset($address)? $address:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <!-- <div class="row pb-3">
                    <label for="favorite" class="col-md-2 col-form-lable">Favorite:</label>
                    <div class="col-md-10 d-flex">
                        <div class="form-check pe-3 my-auto">
                            <input type="checkbox" name="music" id="favorite" class="form-check-input">
                            <label for="maleRd" class="form-check-label">Music</label>
                        </div>

                        <div class="form-check my-auto">
                            <input type="checkbox" name="reading" id="favorite" class="form-check-input">
                            <label for="femaleRd" class="form-check-label">Reading</label>
                        </div>
                    </div>
                </div> -->
                <div class="row pb-3 ps-5 pe-5 ms-auto">
                    <div class="col-md-12 d-flex justify-content-end">
                        <input type="submit" value="Đăng ký" class="btn btn-primary" name="btnRegister"
                            id="btnRegister">
                    </div>
                </div>
            </form>
        </div>
    </body>

</html>