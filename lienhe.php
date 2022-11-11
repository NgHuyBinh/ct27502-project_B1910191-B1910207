<?php 
    require_once "header.php";
    if(isset($_GET['submitphanhoi'])){
        $hoten = $email = $noidung = $hinhthuc= '';
        if(isset($_GET['hoten'])){
            $hoten = $_GET['hoten'];
        }
        if(isset($_GET['email'])){
            $email = $_GET['email'];
        }
        if(isset($_GET['hinhthuc'])){
            $hinhthuc = $_GET['hinhthuc'];
        }
        if(isset($_GET['noidung'])){
            $noidung = $_GET['noidung'];
        }
        //fix lỗi SQL Injection
        $hoten = str_replace('\'','\\\'',$hoten);
        $email = str_replace('\'','\\\'',$email);
        $noidung = str_replace('\'','\\\'',$noidung);
        $errors = array();
        if($hoten == ''){
            $errors['hoten'] = 'Vui lòng nhập họ tên của bạn';
        }
        if($email == ''){
            $errors['email'] = 'Vui lòng nhập email của bạn';
        }
        if($hinhthuc ==''){
            $errors['hinhthuc'] = 'Vui lòng chọn hình thức phản hồi';
        }
        if($noidung == ''){
            $errors['noidung'] = 'Vui lòng nhập nội dung phản hồi';
        }
        if(!$errors){
            $sql = "INSERT into phanhoi SET hoten = ?, email = ?, hinhthuc=?,noidung=?";
            $query = $conn->prepare($sql);
            $query->execute([$hoten,$email,$hinhthuc,$noidung]);
            
            if($conn->lastInsertId()){
                $message = "Gửi phản hồi thành công! Xin cám ơn quý khách đã đóng góp ý kiến để Mona hoàn thiện hơn.";
                echo "<script>alert('$message'); location.href = 'http://localhost/nonbaohiem/lienhe.php';</script>";
            }
        }else{
            $message = "Gửi phản hồi thất bại! Quý khách vui lòng điền đầy đủ thông tin để thực hiện góp ý cho Mona.";
                echo "<script>alert('$message'); location.href = 'http://localhost/nonbaohiem/lienhe.php';</script>";
        }
    
        }

?> 
<div class="lienhe" style="margin-bottom: 5%;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841454343738!2d105.76842661468002!3d10.029938975270296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1662731557466!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <section class="main_contact" >
            <h2 style="font-weight:bold;color:#b2b509">Ý kiến đóng góp</h2>
            <h3 style="font-weight:bold;color:#b2b509">Những ý kiến đánh giá, đóng góp từ quý khách sẽ giúp MONA dần trở nên hoàn thiện hơn!
                
            </h3>
            <form class="form_contribute" method="GET" id="form-phanhoi" style="margin:0 auto;">
                <div class="inputGroup">
                    <label for="">Họ tên</label>
                    <input type="text" required name="hoten">
                </div>
                <div class="inputGroup">
                    <label for="">Email</label>
                    <input type="text" required name="email">
                </div>
                <div class="inputGroup">
                    <label for="">Hình thức</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="exampleFormControlInput3" name="hinhthuc">
                                    <option selected value=''> Chọn hình thức</option>
                                    <option value="Thái độ nhân viên">Về thái độ phục vụ khách hàng</option>
                                    <option value="Chất lượng sản phẩm">Về chất lượng sản phẩm</option>
                                    <option value="Giá thành sản phẩm">Về giá thành sản phẩm</option>
                                </select>
                </div>
                <div class="inputGroup">
                    <label for="">Nội dung</label>
                    <input type="text" required name="noidung">
                </div>
                <div class="inputGroup">
                    
                    <input type="submit" name="submitphanhoi" value="Gửi" class="btn btn-success">
                </div>
            </form>

        </section>
</div>


<?php 
    require_once "footer.php";
?> 