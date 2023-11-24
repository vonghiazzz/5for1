<!-- header -->
<?php
  include_once 'header.php';
  $c = new Connect();
  $dblink = $c->connectToMySQL();
// $sql = "SELECT * FROM product p join category c where p.pCat_id = c.pCat_id and parentCat='Womens Fashion'";
// $re = $dblink->prepare($sql);

?>
  
<!-- Column: .col 
    Prefix class:
      - c - mobile`
      - m - tablet
      - l - PC
-->


<div class="d-grid col-12" style="height: 560px">
  <video playsinline autoplay muted loop poster="my-video.jpg" width="100%" height="100%">
    <source src="./images/yt2s.mp4">
  </video>


</div>

<div class=" col-12 d-inline-flex mx-auto" style="background-color:white">
    <div class="col-6 mx-auto">
      <div class="hover">
        <img src="./images/MR1.jpg" id="Avatar" class="image"style="height: 480px; " >
        <div class="middle">
          <a href="search.php?search=Online&btnSearch=" style="text-decoration: none; font-size:30px;" class="text-black"><b>Du lịch Online</b></a>
        </div>
      </div>
    </div>

    <div class="col-6 mx-auto">
      <div class="hover">
        <img src="./images/NoMR1.jpg" id="Avatar" class="image" style="height: 480px;" >
        <div class="middle">
          <a href="search.php?search=Offline&btnSearch=" style="text-decoration: none; font-size:30px;" class="text-black"><b>Du lịch Offline</b></a>
        </div>
      </div>
    </div>
  </div>

<div class="grid pt-4 text-center" style="text-decoration: none; font-size:22px;">
  <p><b>Điểm du lịch hot trong tuần</b></p>
</div>
<div class="row ">
<?php  
   $sql = "SELECT * FROM `product` ORDER by date DESC LIMIT 6";
   //1
   $re = $dblink->query($sql);
   $re->data_seek(0);     //Lấy tại vị trí đầu tiên trong cơ sở dữ liệu 
   if ($re->num_rows > 0): //Sử dụng : thay {}
       while ($row = $re->fetch_assoc())://fetch_assoc Gọi theo tên của cột trong cơ sở dữ liệu              
?>  
   <div class="col-md-2 pb-3">
        <div class="card">
          <img src="./images/<?= $row['pImage']?>" onclick="window.location.href='detail.php?id=<?=$row['pID']?>'" 
          style=" width: 225px; height: 280px;">
          <h5 class="card-title text-dark" style="text-align: center; height:100px;">
            <p> <a href="detail.php?id=<?=$row['pID']?>" style="text-decoration: none;" class="text-dark"><b><?= $row['pName']?></b></a></p>
          </h5>
            <h6 class="card-subtitle mb-2 text-muted bi bi-currency-dollar"> <?= $row['pPrice']?></h6>
          <!-- <a href="cart.``php" class="btn btn-dark">Add to Cart</a> -->
        </div>
   </div>
  <?php
        endwhile; 
        else:
        echo "Not Found";
    endif;
  ?>
<?php
include_once 'footer.php';
?>
</div>