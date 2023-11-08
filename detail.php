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
    
    <div class="container" >
        <img src="./images/<?=$re1['pImage']?>" height="300px" width="300px">
    </div>
    <form action="cart.php?id=<?=$re1['pID']?>" method="GET">
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
            <input type="submit" class="btn btn-dark shop-button"
            name="btnAdd" value="Add to Cart">
        </div>
    </form>

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