
<?php include('header.php') ;
    if(!isset($_SESSION['username'])){
        header('location: index.php');
        exit();
    }
    if(isset($_GET['id'])){
        $id =$_GET['id'];
        $sql ="SELECT * FROM non where id=?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
        $count= $query->rowCount();
        if($count>0){
            $rows = $query->fetchAll(PDO:: FETCH_OBJ);
            foreach ($rows as $row){
                $non = htmlentities($row->tieude);
                $gia = htmlentities($row->gia);
                $hinhanh = htmlentities($row->hinhanh);
                $noibat = htmlentities($row->noibat);

            }
           
        }else{
            header('location: index.php');
            exit();
        }
    }else{
        header('location: index.php');
        exit();
    }
    if(isset($_POST['dathang'])){
        $tenkhachhang = $diachikhachhang = $emailkhachhang =$sdtkhachhang ='';
        if(isset($_POST['non'])){
            $non = $_POST['non'];
        }
        if(isset($_POST['gia'])){
            $gia = $_POST['gia'];
        }
        if(isset($_POST['soluong'])){
            $soluong = $_POST['soluong'];
        }
        $tongcong = $soluong * $gia;
        $ngaydat = date("Y-m-d h:i:sa");
        $trangthai="Đã đặt";
        if(isset($_POST['tenkhachhang'])){
            $tenkhachhang = $_POST['tenkhachhang'];
        }
        if(isset($_POST['sdtkhachhang'])){
            $sdtkhachhang = $_POST['sdtkhachhang'];
        }
        if(isset($_POST['diachikhachhang'])){
            $diachikhachhang = $_POST['diachikhachhang'];
        }
        if(isset($_POST['emailkhachhang'])){
            $emailkhachhang = $_POST['emailkhachhang'];
        }

        $errors = array();
        if(!$errors){
            $sql = "INSERT INTO dathang(`non`, `gia`, `soluong`, `tongcong`, `ngaydat`, `trangthai`, `tenkhachhang`, `sdtkhachhang`, `emailkhachhang`, `diachikhachhang`) 
            VALUES (?,?,?,?,?,?,?,?,?,?)";
            $query = $conn->prepare($sql);
            $query->execute([$non,$gia,$soluong,$tongcong,$ngaydat,$trangthai,$tenkhachhang,$sdtkhachhang,$emailkhachhang,$diachikhachhang]);
            
                $message = "Đặt hàng thành công! Xin cám ơn quý khách đã tin dùng nón bảo hiểm tại Mona.";
                echo "<script>alert('$message'); location.href = 'http://ct275-project.localhost/nonbaohiem.php';</script>";
            
        }
    }
    
?>
    <style>
        .drink-search input[type='text']{
            width: 250px;
            height: 28px;
            border: 1px solid #000;
            border-radius: 3px;
            font-family: 'Nunito', sans-serif;
        }
        .drink-search input[type='submit']{
            height: 30px;
            width: 80px;
            background-color: #edbc6e;
            /* border-color: #e99714; */
            border: 0px solid #edbc6e;
            border-radius: 5px;
            font-family: 'Nunito', sans-serif;
        }

        .drink-search input[type='submit']:hover {
            background-color: #e99714;
            transition: .5s;
        }
        .order {
            width: 50%;
            margin: 0 auto;
        }

        .order legend, .order h3, .order-label, .order input, .order textarea {
            font-family: 'Nunito', sans-serif;
        }

        .input-responsive {
            width: 96%;
            padding: 1%;
            margin-bottom: 3%;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .order-label {
            margin-bottom: 1%;
            font-weight: bold;
        }
        .drink-menu-img {
            width: 20%;
            float: left;
        }
        .img-responsive {
            width: 100%;
        }
        .img-curve {
            border-radius: 15px;
        }
        .drink-menu-desc .btn {
            background-color: #e99714;
            height: 30px;
            width: 100px;
        }
        .text-left {
            text-align: left;
        }
        .drink-price {
            font-size: 1.2rem;
            margin: 2% 0;
        }

        .drink-detail {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1rem;
            color: #747d8c;
        }
    </style>
    <main >
        <!-- Drink Search Section Starts -->
        <section class="drink-search text-center" style=" background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(242,222,8,1) 39%, rgba(0,255,237,1) 77%);padding-bottom:25px;">
            <div class="container">
                <h2 class="text-center">Điền thông tin chi tiết đặt hàng vào bên dưới</h2>

                <form class="order" method="POST">
                    <fieldset>
                        <legend>Nón bảo hiểm</legend>

                        <div class="drink-menu-img">
                            <img src="images/<?php echo $hinhanh;?>"
                                class="img-responsive img-curve">
                        </div>

                        <div class="drink-menu-desc">
                            <h3 class="text-left"><?php echo $non; ?></h3>
                            <input type="hidden" name="non" value="<?php echo $non; ?>">
                            <p class="drink-price text-left"><?php echo $gia; ?>đ</p>
                            <input type="hidden" name="gia" value="<?php echo $gia; ?>">

                            <div class="order-label text-left">Số lượng</div>
                            <input type="number" name="soluong" class="input-responsive" value="1" required min=1>

                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>Chi tiết giao hàng</legend>
                        <div class="order-label" style="text-align:center;">Họ tên</div>
                        <input type="text" name="tenkhachhang" placeholder="VD: Vi Nghĩa Đạt"
                            class="input-responsive" required>

                        <div class="order-label  text-left">Số điện thoại</div>
                        <input type="number" name="sdtkhachhang" placeholder="VD: 0900xxxxxx" class="input-responsive" required min=1 >

                        <div class="order-label text-left">Email</div>
                        <input type="email" name="emailkhachhang" placeholder="VD: datB1910207@student.ctu.edu.vn"
                            class="input-responsive" required>

                        <div class="order-label text-left">Địa chỉ</div>
                        <textarea name="diachikhachhang" rows="10" placeholder="Gò Quao-Kiên Giang"
                            class="input-responsive" required></textarea>

                        <input type="submit" name="dathang" value="Hoàn tất" class="btn btn-primary" style="font-weight: bold;">
                    </fieldset>

                </form>
            </div>
        </section>
    </main>
    <?php include('footer.php') ?>