<?php
include_once 'header.php';
if (isset($_SESSION['user_name'])) //check if user logged into website
    $user = $_SESSION['user_name'];
    $user_id = $_SESSION['userid'];
$error="";
    if(isset($_POST['btnUpdateUser']) == true){             // isset được dùng để xóa cảnh báo define 
        if(isset($_POST['email']) && isset($_POST['pass'])&& isset($_POST['repass'])
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
                $c = new Connect();
                $dblink = $c->connectToPDO();
                $sql ="UPDATE `user` SET `email`=?,`fullname`=?,`gender`=?,`address`=?,`password`=?,`role`=?, `phone`=?,`birthday`=? WHERE user_id=$user_id";
                  $result = $dblink->prepare($sql);     //dưa trỏ vô CSDL
                  $stm =  $result->execute(array("$email","$fullname","$gender","$address","$pass","user","$phone","$birth"));
                    if($stm == true){
                        echo"You have created account successfully!";
                    }
                    else{
                        echo"<div class='alert alert-danger text-center'>Email has used!</div>";
                    }
                }
            }            
    }
    ?>

<body>
        <div class="container">
            <h2>Registration</h2>
            <form action="" id="form1" name="form1" method="post" class="needs-validation">

                <div class="row pb-3">
                    <?php if($error!="") {?>
                    <div class="alert alert-danger"><?php echo $error?></div>
                    <?php } ?>
                </div>
                <div class="row pb-3">
                    <label for="fullname" class="col-md-2 col-form-lable">Full name:</label>
                    <div class="col-md-10">
                        <input type="text" name="fullname" id="fullname"  required class="form-control"
                            placeholder="Enter your full name" value="<?=isset($fullname)? $fullname:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <!-- <div class="row pb-3">
                    <label for="username" class="col-md-2 col-form-lable">User name:</label>
                    <div class="col-md-10">
                        <input type="text" name="username" id="username" required class="form-control"
                            placeholder="Enter your user name" value="<?php //echo isset($username)? $username:""?>"> -->
                        <!--id với for giống nhau để chuyển sang id được -->
                    <!-- </div> -->
                <!-- </div> -->
                <div class="row pb-3">
                    <label for="pass" class="col-md-2 col-form-lable">Password:</label>
                    <div class="col-md-10">
                        <input type="password" name="pass" id="pass" required class="form-control"
                            placeholder="Enter your password" value="<?=isset($pass)? $pass:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="repass" class="col-md-2 col-form-lable">Confirm password:</label>
                    <div class="col-md-10">
                        <input type="password" name="repass" id="repass" required class="form-control"
                            placeholder="Enter your password again" value="<?=isset($repass)? $repass:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="phone" class="col-md-2 col-form-lable">Phone:</label>
                    <div class="col-md-10">
                        <input type="text" name="phone" id="phone" required class="form-control"
                            placeholder="Enter your phone" value="<?=isset($phone)? $phone:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="email" class="col-md-2 col-form-lable">Email:</label>
                    <div class="col-md-10">
                        <input type="text" name="email" id="email" required class="form-control"
                            placeholder="Enter your email" value="<?=isset($email)? $email:""?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="gender" class="col-md-2 col-form-lable">Gender:</label>
                    <div class="col-md-10 d-flex">
                        <div class="form-check pe-3 my-auto">
                            <input type="radio" name="gender" id="maleRd" class="form-check-input" value="1"
                                <?= isset($gender)==1?"checked":""?>>
                            <!--id với for giống nhau để chuyển sang id được -->
                            <label for="maleRd" class="form-check-label">Male</label>
                        </div>

                        <div class="form-check my-auto">
                            <input type="radio" name="gender" id="femaleRd" class="form-check-input" value="0"
                                <?= isset($gender)==0?"checked":""?>>
                            <!--id với for giống nhau để chuyển sang id được -->
                            <label for="femaleRd" class="form-check-label">Female</label>
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
                <div class="row pb-3">
                    <label for="birthday" class="col-md-2 col-form-lable">Birthday:</label>
                    <div class="col-md-10">
                        <input type="date" name="txtBirth" id="txtBirth" value="<?= $_POST??""?>" required
                            class="form-control" value="<?=  $formatedDate?? "";?>"
                            value="<?=isset($birthday)? $birthday:""?>" />
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="address" class="col-md-2 col-form-lable">Address:</label>
                    <div class="col-md-10">
                        <input type="text" name="address" id="address" required class="form-control"
                            placeholder="Enter your address" value="<?=isset($address)? $address:""?>">
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
                <div class="row pb-3 ms-auto">
                    <div class="col-md-12 d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary" name="btnUpdateUser" id="btnUpdateUser">
                    </div>
                </div>
            </form>
        </div>
    </body>