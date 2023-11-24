<?php
  include_once 'header.php';
?>

<div class="container px-4 py-5">
    <?php
    if(isset($_GET['id'])):
        $pID = $_GET['id'];
        include_once 'connect.php';
        $conn = new Connect();
        $db_link= $conn->connectToPDO();
        // $sql = "SELECT * FROM product WHERE pID=?";
        // $stmt = $db_link->prepare($sql);
        // $stmt->execute(array("$pID"));
        // $re = $stmt->fetch(PDO::FETCH_BOTH);

        //  "SELECT pID, pName, pPrice, pQuantity, `catName`, pImage 
        // FROM category b, product a 
        // WHERE a.pCat_id = b.pCat_id ORDER BY date DESC;"

        $sql1 = "SELECT * FROM
        category b, product a WHERE a.pCat_id = b.pCat_id and pId=?";
        $stmt1 = $db_link->prepare($sql1);
        $stmt1->execute(array("$pID"));
        $re1 = $stmt1->fetch(PDO::FETCH_BOTH);
    ?>

   
    <form action="cart.php?id=<?=$re1['pID']?>" method="GET">
    <input type="hidden" name="pID" value="<?=$pID?>">
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage1']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage2']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage3']?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage1']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage2']?>" alt="">
                        </div>

                        <div class="product-preview">
                            <img src="./images/<?=$re1['pImage3']?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name"><?=$re1['pName']?></h2>
                        <!-- <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Review(s) | Add your review</a>
                        </div> -->
                        <div >                               
                            <h3 class="product-price">$<?=$re1['pPrice']?> </h3>
                                <!-- <del class="product-old-price">$990.00</del></h3>
                            <span class="product-available">In Stock</span> -->
                        </div>
                        <p class="text-justify">Mô tả: <?=$re1['pDesc']?></p>

                        <!-- <div class="product-options">
                            <label>
                                Size
                                <select class="input-select">
                                    <option value="0">X</option>
                                </select>
                            </label>
                            <label>
                                Color
                                <select class="input-select">
                                    <option value="0">Red</option>
                                </select>
                            </label>
                        </div> -->

                        <div class="add-to-cart">
                            <!-- <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div> -->
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                            <!-- <input type="submit" class="btn btn-dark shop-button" name="btnAdd" value="Add to Cart"> -->
                        </div>

                        <!-- <ul class="product-btns">
                            <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                        </ul> -->

                        <ul class="product-links">
                            <li>Danh mục:</li>

                            <li><a href="#"><?=$re1['catName']?></a></li>
                            <!-- <li><a href="#">Accessories</a></li> -->
                        </ul>

                        <!-- <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul> -->

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <!-- <div class="col-md-12">
                    <div id="product-tab"> -->
                        <!-- product tab nav -->
                        <!-- <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            <li><a data-toggle="tab" href="#tab2">Details</a></li> -->
                            <!-- <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li> -->
                        <!-- </ul> -->
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <!-- <div class="tab-content"> -->
                            <!-- tab1  -->
                            <!-- <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <!-- <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /tab2  -->

                            <!-- tab3  -->
                            <!-- <div id="tab3" class="tab-pane fade in">
                                <div class="row"> -->
                                    <!-- Rating -->
                                    <!-- <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>4.5</span>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 80%;"></div>
                                                    </div>
                                                    <span class="sum">3</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <span class="sum">2</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <!-- <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                            do eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                            do eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                            do eiusmod tempor incididunt ut labore et dolore magna
                                                            aliqua</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="reviews-pagination">
                                                <li class="active">1</li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <!-- <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form">
                                                <input class="input" type="text" placeholder="Your Name">
                                                <input class="input" type="email" placeholder="Your Email">
                                                <textarea class="input" placeholder="Your Review"></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label
                                                            for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label
                                                            for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label
                                                            for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label
                                                            for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio"><label
                                                            for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div> -->
                                    <!-- /Review Form -->
                                <!-- </div>
                            </div> -->
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    </form>
    <!-- <form action="cart.php?id=<?=$re1['pID']?>" method="GET">
        <div class="col-lg-9">
            <input type="hidden" name="pID" value="<?=$pID?>">
            <h2><?=$re1['pName']?></h2>
            <ul style="list-style-type: none;" class="list-group py-2">
                Product Category: <li class="list-group-item"><?=$re1['pCat_id']?></li>
                Name Product Category: <li class="list-group-item"><?=$re1['catName']?></li>
                Price: <li class="list-group-item"><?=$re1['pPrice']?><span class="bi bi-currency-dollar"></span></li>
                Quantity: <li class="list-group-item"><?=$re1['pQuantity']?></li>
                Description: <li class="list-group-item"><?=$re1['pDesc']?></li>
            </ul>
            <input type="submit" class="btn btn-dark shop-button" name="btnAdd" value="Add to Cart">
        </div>
    </form> -->

    <?php
    else:
        ?>
    <h2>Nothing to show</h2>
    <?php
    endif;
        ?>


</div>
<?php
include_once 'footer.php';
?>

