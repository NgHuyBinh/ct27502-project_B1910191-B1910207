<?php include('header.php') ;
if(!isset($_SESSION['admin'])){
    header('location: ../dangnhap.php');
}
    if(isset($_POST['save'])){
        $tieude =$noibat=$gia='';
        $errors = array();
        if(isset($_POST['tieude'])){
            $tieude = $_POST['tieude'];
        }
        
        if(isset($_POST['gia'])){
            $gia = $_POST['gia'];
        }
        //Hình ảnh
        
        if(isset($_FILES['hinhanh']['name'])){
            $tenhinhanh = $_FILES['hinhanh']['name'];
            $tmp = explode('.', $tenhinhanh);
            $duoimorong = end($tmp);
            $tenhinhanh = "non".rand(000,999).'.'.$duoimorong;
            
            $diachinguon = $_FILES['hinhanh']['tmp_name'];
            $diachidich = "../images/".$tenhinhanh;
            //Tải hình ảnh lên
            $upload = move_uploaded_file($diachinguon,$diachidich);
            if($upload == false){
                $errors['hinhanh']="<div class='text-danger'><b>Chưa tải hình ảnh được!</b></div>";
            }
        }
        //Hình ảnh
        if(isset($_POST['noibat'])){
            $noibat = $_POST['noibat'];
        }
        
        
        //fix lỗi Injection
        $tieude = str_replace('\'','\\\'',$tieude);
        
        

        if($tieude == ''){
            $errors['tieude'] ="<div class='text-danger'><b>Bạn chưa nhập tiêu đề!</b></div>";
        }
        
        if($gia<=0 || $gia%1000!=0){
            $errors['gia']="<div class='text-danger'><b>Vui lòng nhập giá lớn hơn 0 và chia hết cho 1000</b></div>";
        }
        if($gia == ''){
            $errors['gia'] ="<div class='text-danger'><b>Bạn chưa nhập giá!</b></div>";
        }
        if($noibat == ''){
            $errors['noibat'] ="<div class='text-danger'><b>Bạn chưa chọn nón nổi bật!</b></div>";
        }
        
        // echo $tieude." ".$mota." ".$gia." ".$noibat." ".$active." ".$tenhinhanh;

        if(!$errors){
            $sql = "INSERT into non(tieude,gia,hinhanh,noibat) values(:tieude,:gia,:tenhinhanh,:noibat)";
            
            $query = $conn->prepare($sql);
            $query->bindParam(':tieude', $tieude, PDO::PARAM_STR);
            $query->bindParam(':gia', $gia, PDO::PARAM_STR);
            $query->bindParam(':tenhinhanh', $tenhinhanh, PDO::PARAM_STR);
            $query->bindParam(':noibat', $noibat, PDO::PARAM_STR);
            $query->execute();

            if($conn->lastInsertId()){
                $message = "Bạn đã thêm nón bảo hiểm thành công!";
                echo "<script>alert('$message'); location.href = 'http://ct275-project.localhost/admin/index.php';</script>";
            }
        }else{
            $_SESSION['themnon'] = "<div class='text-danger mb-3 text-center'><b>Thêm nón thất bại</b></div>";
        }

    }
?>
<br><br><br>
<div class="container">
<a href="index.php" class="btn add_admin">< Quay lại</a>
    <h2 class="text-center mt-4 mb-4" style="background-color:#FFEFD5;">Thêm nón bảo hiểm</h2>
    <?php 
        if(isset($_SESSION['themnon'])){
            echo $_SESSION['themnon'];
            unset($_SESSION['themnon']);
        }
    ?>
    <form  method="POST" enctype="multipart/form-data">
            <div class="row mt-4 mb-5">
                <label for="tieude" class="form-label col-sm-2 text-end "><strong>Nhập tiêu đề</strong></label>
                <div class="col-sm-9">
                    <input type="tieude" class="form-control" id="tieude" placeholder="Tiêu đề nón bảo hiểm" name="tieude" value="<?php if(isset($tieude)){echo $tieude;} ?>">
                    <?php 
                    if(isset($errors['tieude'])){
                        echo $errors['tieude'];
                    }
                ?>
                </div>
                
            </div>
            
            <div class="row mb-5">
                <label for="gia" class="form-label col-sm-2 text-end "><strong>Nhập giá</strong></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="gia" placeholder="Giá nón" name="gia" value="<?php if(isset($gia)){echo $gia;} ?>">
                    <?php 
                    if(isset($errors['gia'])){
                        echo $errors['gia'];
                    }
                ?>
                </div>
            </div>
            <div class="row mb-5">
                <label for="hinhanh" class="form-label col-sm-2 text-end "><strong>Chọn hình ảnh</strong></label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh">
                    <?php 
                    if(isset($errors['hinhanh'])){
                        echo $errors['hinhanh'];
                    }
                ?>
                </div>
            </div>
            <div class="row mb-5">
                <label for="noibat" class="form-label col-sm-2 text-end "><strong>Sản phẩm nổi bật</strong></label>
                <div class="col-sm-9">
                    <span><input type="radio" name="noibat" value="Có" <?php if(isset($noibat) && $noibat == 'Có'){echo "checked='checked'";}?>>Có</span>
                    <span class="mx-3"><input type="radio" name="noibat" value="Không" <?php if(isset($noibat) && $noibat == 'Không'){echo "checked='checked'";}?>>Không</span>
                    <?php 
                        if(isset($errors['noibat'])){
                            echo $errors['noibat'];
                        }
                    ?>
                </div>
            </div>
            
            <button class="btn btn-success offset-sm-2" name="save">Lưu lại</button>
    </form>
    
</div>

<?php include('../footer.php') ?>