<?php
    include_once "header.php";
?>
<div class="container px-4 py-3">
  <h2>All product</h2>
  <div class="row">
    <?php
                include_once 'connect.php';
                $c = new Connect();
                $dblink = $c->connectToPDO();

               // $sql = "SELECT * FROM product where pName LIKE CONCAT('%',:nameP,'%')";   
                
              
              //  $re->bindParam(':nameP',$nameP, PDO::PARAM_STR);
               // $re->execute();  
              if (isset($_GET['btnSearch'])&& isset($_GET['search']))://user enter btnSearch <1>
                  $search = $_GET['search'];
                  $sql = "SELECT * FROM product where pName LIKE ?";  //and pPride>?  
                  $re = $dblink->prepare($sql);
                  $re->execute(array("%$search%"));               
              else:
                  $sql = "SELECT * FROM product";
                  $re = $dblink->prepare($sql);
                  $re->execute(array());
              endif;//if <1>
              if($re->rowCount()==0)://if <2>
                echo "Not found!";
              else://else <2>           
                $rows = $re-> fetchALL(PDO::FETCH_BOTH);
              //if <2>
                // if(isset($_GET['search']) == ""){
                foreach($rows as $r):
                   // $row1 = $re->fetch_row();
                // echo $row1[4];
                // echo "<br>";
                // $re->data_seek(0); //khi chay thi quay lai vong dau
                // if($re->num_rows>0):
                    // while($rows=$re->fetch_assoc()):  //fetch_assoc: lay dua tren ten cot. Neu nho vi tri thi dung fetch_row
                
            ?>
              <div class="col-md-3 pb-3">
                <div class="card">
                  <img src="./images/<?= $r['pImage']?>" class="card-img-top" alt="Product1>" style="margin: auto;
                                  width: 300px; height: 300px;" />
                  <div class="card-body" style="text-align: center; height:120px;">
                    <a href="detail.php?id=<?=$r['pID']?>" class="text-decoration-none">
                      <h5 class="card-title text-dark">
                        <?= $r['pName']?>
                      </h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted bi bi-currency-dollar"><?= $r['pPrice']?> VND</h6>
                    <!-- <a href="#" class="btn btn-primary">Add to Cart</a> -->
                  </div>
                </div>
              </div>
              <?php
          endforeach; 
        endif; 
        // }
        // else{
        //     echo "Not Found";
        // }
        // else:
    //     echo "Not Found";
    ?>
  </div>
</div>
<?php
    include_once "footer.php";
?>