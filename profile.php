<?php
include_once 'header.php';
if (isset($_SESSION['user_name'])) //check if user logged into website
    $user = $_SESSION['user_name'];
    $user_id = $_SESSION['userid'];

    $sql = "SELECT * FROM user where user_id=$user_id ";
    $re = $dblink->query($sql);
    if($re->num_rows<2):
        while($row = $re->fetch_assoc()):
            
            $birthday =date('d-m-Y',strtotime($row['birthday']));

?>
    <body>
        <div class="container">
            <h2>My Profile</h2>
            <form action="" id="form1" name="form1" method="post" class="needs-validation">

                <div class="row pb-3">
                    <label for="fullname" class="col-md-2 col-form-lable">Full name:</label>
                    <div class="col-md-10">
                        <input type="text" name="fullname" id="fullname" readonly required class="form-control"
                            placeholder="Enter your full name" value="<?=$row['fullname']?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <!-- <div class="row pb-3">
                    <label for="username" class="col-md-2 col-form-lable">User name:</label>
                    <div class="col-md-10">
                        <input type="text" name="username" id="username" required class="form-control"
                            placeholder="Enter your user name" value="<?php //echo isset($username)? $username:""?>">
                        id với for giống nhau để chuyển sang id được 
                    </div>
                </div> -->
                <div class="row pb-3">
                    <label for="pass" class="col-md-2 col-form-lable">Password:</label>
                    <div class="col-md-10">
                        <input type="password" name="pass" id="pass" readonly required class="form-control"
                            placeholder="Enter your password" value="<?=$row['password']?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>

                <div class="row pb-3">
                    <label for="phone" class="col-md-2 col-form-lable">Phone:</label>
                    <div class="col-md-10">
                        <input type="text" name="phone" id="phone" readonly required class="form-control"
                            placeholder="Enter your phone" value="<?=$row['phone']?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="email" class="col-md-2 col-form-lable">Email:</label>
                    <div class="col-md-10">
                        <input type="text" name="email" id="email" readonly required class="form-control"
                            placeholder="Enter your email" value="<?=$row['email']?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="gender" readonly class="col-md-2 col-form-lable">Gender:</label>
                    <div class="col-md-10 d-flex">
                        <div class="form-check pe-3 my-auto">
                            <input type="radio" name="gender" id="maleRd" class="form-check-input"  value="1"
                                <?= isset($row['gender'])==1?"checked":""?>>
                            <label for="maleRd" class="form-check-label">Male</label>
                        </div>

                        <div class="form-check my-auto">
                            <input type="radio" name="gender" id="femaleRd" class="form-check-input"  value="0"
                                <?= isset($row['gender'])==0?"checked":""?>>
                            <!--id với for giống nhau để chuyển sang id được -->
                            <label for="femaleRd" class="form-check-label">Female</label>
                        </div>
                    </div>

                </div>
                <!-- <div class="row pb-3">
                    <label for="country" class="col-md-2 col-form-lable">Country:</label>
                    <div class="col-md-10">
                        <select id="country" class="form-select" name="country"
                            value="<?// echo isset($country)? $country:"$row[country]"?>">
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
                    <input type="text" name="address" id="address" readonly required class="form-control"
                            placeholder="Enter your address" value="<?=$birthday?>">
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="address" class="col-md-2 col-form-lable">Address:</label>
                    <div class="col-md-10">
                        <input type="text" name="address" id="address" readonly required class="form-control"
                            placeholder="Enter your address" value="<?=$row['address']?>">
                        <!--id với for giống nhau để chuyển sang id được -->
                    </div>
                </div>
                <?php
endwhile; 
else:
echo "Error, user id has exist!";
endif;
?>

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
                        <button onclick="window.location.href='Update_profile.php'" type="button" class="btn btn-primary">
                        Change my profile</button>
                    </div>
                </div>
            </form>
        </div>
    </body>



