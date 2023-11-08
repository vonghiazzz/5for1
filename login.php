<?php
include_once("connect.php");
session_start();
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
                <button onclick="window.location.href='registration.php'" class="btn btn-outline-secondary" type="button">Đăng ký</button>
            </form>
        </div>
    </nav>

<?php
// echo 'PHP version: ' . phpversion();
    $error="";
    if (isset($_POST['btnLogin']) == true) { // isset được dùng để xóa cảnh báo define 
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $c = new Connect();
            $dblink = $c->connectToPDO();
            $sql = "SELECT * FROM user WHERE email = ? and password = ?";
            $stm = $dblink->prepare($sql);
            $re = $stm->execute(array("$email", "$password"));
            $numrow = $stm->rowCount();
            $row = $stm->fetch(PDO::FETCH_BOTH);
            if($numrow==1){
                echo "Login successfully";
                $_SESSION['user_name'] = $row['fullname'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['userid'] = $row['user_id'];
                
            // setcookie("cc_username", $row['fullname'], time() + 180);
            // setcookie("cc_id", $row['id'], time() + 180);
                header("Location: index.php");
            }
            else{
                $error = "Something wrong with your infor<br>";
            }
    
        }else{
            $error= "Please enter again!";
        }
    } 
?>

<body>
<div class="container pb-5 pe-5 ps-5">
            <div class="row ps-5 pe-5">
                <h2>Đăng nhập</h2>
            </div>
            <form action="" id="form1" name="form1" method="post" class="needs-validation">
              
                    <div class="row pb-3 ps-5 pe-5">
                        <?php if($error!="") {?>
                            <div class="alert alert-danger"><?php echo $error?></div>
                        <?php } ?>
                    </div>
                    <div class="row pb-3 ps-5 pe-5">
                        <label for="email" class="col-md-2 col-form-lable">Email:</label>
                        <div class="col-md-10">
                            <input type="text" name="email" id="email" required class="form-control"
                                placeholder="Điền email" value="<?=isset($email)? $email:""?>">
                            <!--id với for giống nhau để chuyển sang id được -->
                        </div>
                    </div>

                <div class="row pb-5 ps-5 pe-5">
                        <label for="pass" class="col-md-2 col-form-lable">Mật khẩu:</label>
                        <div class="col-md-10">
                            <input type="hidden" name="redirect_to" id="redirect_to" value="get_input_text.php">
                            <input type="password" name="password" id="password" required class="form-control"
                                placeholder="Điền mật khẩu" value="<?=isset($pass)? $pass:""?>">
                            <!--id với for giống nhau để chuyển sang id được -->
                        </div>
                </div>
                <div class="row pb-3 ps-5 pe-5 ms-auto">
                    <div class="col-md-12 d-flex justify-content-end">
                        <input type="submit" value="Đăng nhập" class="btn btn-primary" name="btnLogin" id="btnLogin">
                    </div>
                </div>
            </form>
</div>

</body>

</html>
<?php
include_once "footer.php";
?>