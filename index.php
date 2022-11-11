<?php 
    require_once "header.php";
?>
<style>
    /* MONA */
@import url('https://fonts.googleapis.com/css?family=Red+Hat+Display:900&display=swap');
.black-lives-matter {
  font-size: 8vw;
  line-height: 8vw;
  margin: 0;
  font-family: 'Red Hat Display', sans-serif;
  font-weight: 900;
  background-image: url('images/logo201.png');
  background-size: 40%;
  background-position: 50% 50%;
  -webkit-background-clip : text;
  color: rgba(0,0,0,0.08);
  animation: zoomout 10s ease 500ms forwards;
}

@keyframes zoomout {
  from {
    background-size: 40%;
  }
  to {
    background-size: 10%;
  }
}/* MONA */
</style>
<h1 class="black-lives-matter" style="text-align:center">MONA</h1>
<div class="sect-img">
        <img src="images/b2.jpg" alt="" width="100%" height="600px">
</div>
<div class="desc">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="text-center">Lựa chọn nón bảo hiểm phù hợp với chi phí và nhu cầu của bạn</h3>
                    </div>
                    <div class="col-sm-8">
                        <p>Nón bảo hiểm Mona tự tin với những sản phẩm nón chất lượng được nhập khẩu từ các quốc gia nổi tiếng. Từ nón cho em bé đến nón cho người lớn . Đầy đủ các mức giá cho mọi người có thể sở hữu. Thiết kế gọn nhẹ nhưng luôn đảm bảo an toàn tuyệt đối cho người dùng. Mona cam kết hoàn tiền 100% cho khách hàng khi nhận ra sản phẩm là hàng giả hàng nhái hay bị hư hỏng trong quá trình sử dụng. Có thể nói Mona đồng hành bảo vệ bạn trong việc tham gia an toàn giao thông</p>
                    </div>
                </div>
            </div>
</div>
<div class="body">
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel" style="height: 430px;z-index: 2; ">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>
            
                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/1.PNG" alt="non" class="d-block w-100" style="height:450px;">
                    </div>
                    <div class="carousel-item">
                        <img src="images/2.PNG" alt="non" class="d-block w-100" style="height:450px;">
                    </div>    
                    <div class="carousel-item ">
                        <img src="images/3.jpg" alt="non" class="d-block w-100" style="height:450px;">
                    </div>
                
                </div>
            
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            <section class="container" style="z-index:3;position:relative;">
                <div class="row">
                    <div class="text-center col mx-4" style=" 
                    background:white;border:5px ridge;border-radius: 15px;height: 200px">
                        <div >
                            <img src="images/free-delivery.png" alt="">
                            <h5><b>FREESHIP</b></h5>
                            <p>
                                Mona vận chuyển hoàn toàn miễn phí trên mọi miền đất nước.
                            </p>
                        </div>
                        
                    </div>
                    <div class="text-center col mx-4" style="     
                    background:white;border:5px ridge;border-radius: 15px;height: 200px">
                        <div >
                            <img src="images/money.png" alt="">
                            <h5><b>HOÀN TIỀN 100%</b></h5>
                            <p>
                                Mona sẽ hoàn tiền 100% cho quý khách nếu sản phẩm bị lỗi do nhà sản xuất hoặc phát hiện hàng giả, hàng nhái.
                            </p>
                        </div>
                        
                    </div>
                    <div class="text-center col mx-4" style=" 
                    background:white;border:5px ridge;border-radius: 15px;height: 200px">
                        <div >
                            <img src="images/live-chat.png" alt="">
                            <h5><b>HỖ TRỢ 24/7</b></h5>
                            <p>
                                Qúy khách cần thông tin có thể gọi qua số hotline: 0843152525. Cuộc gọi hoàn tiền miễn phí
                            </p>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    <div class="container mt-4" class="sanpham">
        <h3 class="text-center mb-4" style="color:#b2b509;font-weight:bold;">CÁC SẢN PHẨM NỔI BẬT</h3>
        <div class="row text-center">
            <?php
                $sql = "SELECT * FROM non where noibat='Có'";
                $query = $conn->prepare($sql);
                $query->execute();
                $rows = $query->fetchAll(PDO::FETCH_OBJ);
                if ($conn->query($sql) == true) {
                    foreach ($rows as $row) {
                        $id = htmlentities($row->id);
                        $tieude = htmlentities($row->tieude);
                       
                        $gia = htmlentities($row->gia);
                        $hinhanh = htmlentities($row->hinhanh);
                        $noibat = htmlentities($row->noibat);
                        ?>

            <div class="col-sm-4" >
                <div >
                    <img src="images/<?php echo $hinhanh; ?>" width="40%" alt="">
                </div>
                <div>
                    <h5 style="color: #b2b509"><?php echo $tieude; ?></h5>
                    <p><?php echo $gia ?>đ</p>
                </div>
            </div>
            <?php
                    }
                }
                ?>
        </div>
        <div class="text-center"><a href="nonbaohiem.php">Xem thêm</a></div>
    </div>
    <section class="container">
        <div class="row pt-4 pb-4">
            <div class="col">
                <img src="images/logo-01-2.png" alt="">
            </div>
            <div class="col">
                <img src="images/logo-02-2.png" alt="">
            </div>
            <div class="col">
                <img src="images/logo-03-2.png" alt="">
            </div>
            <div class="col">
                <img src="images/logo-04-2.png" alt="">
            </div>
            <div class="col">
                <img src="images/logo-05-2.png" alt="">
            </div>
        </div>
    </section>
    
    <?php 
    require_once "footer.php";
?>