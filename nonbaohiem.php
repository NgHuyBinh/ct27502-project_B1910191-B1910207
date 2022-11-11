<?php 
    require_once "header.php";
?>  
    
        <h1 data-text= "MONA">
        MONA</h1>
    
    
    <style>
        
        h1{
            
        font-family: 'Teko', sans-serif;
        text-transform: uppercase;
        font-size: 10rem;
        text-align: center;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin: 0;
        min-height: calc(10vh - 16px);
        background: white;
        position: relative;
        background: #171717;
        color: #000;
        }

        h1:before{
        content: attr(data-text);
        position: absolute;
        background: linear-gradient(#f70000, #f89200, #f8f501, #038f00,#0168f8, #a200f7);
        -webkit-background-clip: text;
        color: transparent;
        background-size: 100% 90%;
        line-height: 0.9;
        clip-path: ellipse(120px 120px at -2.54% -9.25%);
        animation: swing 5s infinite;
        animation-direction: alternate;
        }

        @keyframes swing{
        0%{
            -webkit-clip-path: ellipse(120px 120px at -2.54% -9.25%)
            clip-path: ellipse(120px 120px at -2.54% -9.25%)
        }
        50%{
            -webkit-clip-path: ellipse(120px 120px at 49.66% 64.36%);
            clip-path: ellipse(120px 120px at 49.66% 64.36%);

        }
        100%{
            -webkit-clip-path: ellipse(120px 120px at 102.62% -1.61%;);
            clip-path: ellipse(120px 120px at 102.62% -1.61%);
        }
        }


    </style>
    <div class="text-center pt-3 pb-3 " style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(136,9,123,1) 35%, rgba(0,212,255,1) 100%);" >
        <form method ="GET">
            <input id="timnonbaohiem" type="text" placeholder="Nhập vào tên nón bảo hiểm..." style="width: 30%;">
        </form>
    </div>
    
    
    <div  class="sanpham" style="background-color:#ececec">
        <h3 class="text-center mb-4" style="color:#b2b509;font-weight:bold;">DANH SÁCH NÓN BẢO HIỂM</h3>
        
            <div class="container list-drink pb-5">
                <div class="row" id="dayne">
                    <?php
                        $sql = "SELECT * FROM non";

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
                    <div class="col-md-6">
                        <div class="drink-menu-box">
                            <div class="drink-menu-img">
                                <img src="images/<?php echo $hinhanh; ?>" class="img-responsive img-curve" style="width:100%;">
                            </div>
                            <div class="drink-menu-desc">
                                <h4><?php echo $tieude; ?></h4>
                                <p class="drink-price"><?php echo $gia ?>đ</p>
                                <p class="drink-detail"></p>
                                <a <?php if (isset($_SESSION['username'])) {
                                            echo "href='dathang.php?id=$id'";
                                        } else {
                                            echo "onclick='yeucaudangnhap()'";
                                        }
                                        ?> class="btn" name="datngay">Đặt ngay</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div> 
                    <?php
                            }
                        }
                        ?>
                    
                                                    
                </div>
            </div>
    </div>
    <script>
        function yeucaudangnhap(){
            swal("Đăng nhập trước khi đặt hàng","");
        }
    </script>
<?php 
    require_once "footer.php";
?> 