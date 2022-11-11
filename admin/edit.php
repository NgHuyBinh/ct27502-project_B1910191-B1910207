<?php include('header.php') ;

if(!isset($_SESSION['admin'])){
    header('location: ../dangnhap.php');
}
    if(isset($_GET['id'])){
        $tieude = $gia = $hinhanh = $noibat = '';
        $id = $_GET['id'];
        $sql = 'SELECT id from non';
        $query = $conn->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);
        $kq = 0;
        foreach ($rows as $row) {
            if($id == htmlentities($row->id)) {
                $kq = 1;
            }
        }
        if($kq == 0) {
            header('location: index.php');
            die();
        }
        $sql = "SELECT * FROM non where id =:id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_OBJ);


        if($query->rowCount() == 1){
            foreach ($rows as $row){
                $tieude = htmlentities($row->tieude);
                       
                        $gia = htmlentities($row->gia);
                        $hinhanh = htmlentities($row->hinhanh);
                        $noibat = htmlentities($row->noibat);
                
            }
        }
    }else{
        header('location: index.php');
        die();
    }
    if(isset($_POST['save'])){
        $tieude  =$noibat=$gia='';
        $errors = array();
        if(isset($_GET['id']) && isset($_POST['tieude']) && isset($_POST['gia']) && isset($_FILES['hinhanh']['name']) &&isset($_POST['noibat'])){

            $id =$_GET['id'];
            $tieude = $_POST['tieude'];
            $gia = $_POST['gia'];
            $noibat = $_POST['noibat'];

            $tenhinhanh = $_FILES['hinhanh']['name'];
            $tmp = explode('.',$tenhinhanh);
            $duoimorong = end($tmp);
            $tenhinhanh = "Non".rand(000,999).'.'.$duoimorong;
            $diachinguon = $_FILES['hinhanh']['tmp_name'];
            $diachidich = "../images/".$tenhinhanh;
            //Tải hình ảnh lên
            $upload = move_uploaded_file($diachinguon,$diachidich);
            if($upload == false){
                $errors['hinhanh']="<div class='text-danger'><b>Chưa tải hình ảnh được!</b></div>";
            }
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

        if(!$errors){
            $sql = "UPDATE `non` SET tieude=?,gia=?,hinhanh=?,noibat=? where id =?";
            $query = $conn->prepare($sql);

            $query->execute([$tieude, $gia, $tenhinhanh, $noibat,$id]);

            
                $_SESSION['themnon1']="<div class='text-success mb-3'><b>Chỉnh sửa nón thành công</b></div>";
                header('location: index.php');
            
        }else{
            $_SESSION['themnon'] = "<div class='text-danger mb-3 text-center'><b>Chỉnh sửa nón thất bại</b></div>";
        }

    }
?>
<br><br><br>
<div class="container show_admin">
    <a href="index.php" class="btn add_admin">< Quay lại</a>
    <h2 class="text-center mt-4" style="background-color:#FFEFD5;">Chỉnh sửa thông tin nón</h2>
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
                    <input type="tieude" class="form-control" id="tieude" placeholder="Tiêu đề nón" name="tieude" value="<?php if(isset($tieude)){echo $tieude;} ?>">
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
                    <input type="number" class="form-control" id="gia" placeholder="Gía nón" name="gia" value="<?php if(isset($gia)){echo $gia;} ?>">
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
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh" value="<?php if(isset($tenhinhanh)){echo $tenhinhanh;} ?>">
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

                    <span><input type="radio" name="noibat" value="Có" <?php if(isset($noibat) && $noibat=='Có'){echo "checked";} ?>  > Có</span>
                    <span class="mx-3"><input type="radio" name="noibat" value="Không" <?php if(isset($noibat) && $noibat=='Không'){echo "checked";} ?> > Không</span>
                    <?php 
                        if(isset($errors['noibat'])){
                            echo $errors['noibat'];
                        }
                    ?>
                </div>
            </div>
            
            <button class="btn offset-sm-2" name="save" style="height: 45px; background-color: #e99714; font-family: 'Nunito', sans-serif; font-weight: bold;">Lưu lại</button>
    </form>
    
</div>

<?php include('../footer.php') ?>