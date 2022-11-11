<?php
    require_once '../config.php';
    $s ='';
    $sql ="SELECT * FROM non";
    if(isset($_GET['search'])){
        $s = $_GET['search'];
    }

    $errors = array();
    if($s == ''){
        $errors['s'] = "Lỗi";
    }
    if(!$errors){
        $sql ="SELECT * FROM non where tieude like '%$s%'";
    }
    $query = $conn->prepare($sql);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_OBJ);


    $kq = '';
    
    if($conn->query($sql) == true){
        foreach ($rows as $row){
            $id = htmlentities($row->id);
                        $tieude = htmlentities($row->tieude);
                        $gia = htmlentities($row->gia);
                        $hinhanh = htmlentities($row->hinhanh);
                        $noibat = htmlentities($row->noibat);
            $kq.='
                <div class="col-md-6">
                        <div class="drink-menu-box">
                            <div class="drink-menu-img">
                                <img src="images/'.$hinhanh.'" class="img-responsive img-curve" style="width:100%;">
                            </div>
                            <div class="drink-menu-desc">
                                <h4>'.$tieude.'</h4>
                                <p class="drink-price">'.$gia.'đ</p>
                                <p class="drink-detail"></p>
                                <a class="btn" name="datngay">Đặt ngay</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
            ';
        }
    }
    echo $kq;
 ?>