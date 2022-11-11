<?php
    require_once '../config.php';
    $username = $password = $email ='';
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    $errors = array();
    if($username == '' || $password == '' || $email == ''){
        $errors['dangky'] = "Lỗi";
    }
    $password = md5($password);
    $sql_sel = "SELECT * FROM khachhang where username=:username";
    $query = $conn->prepare($sql_sel);
    $query->bindParam(':username',$username,PDO::PARAM_STR);

    $query->execute();  
    if($query->rowCount()>0){
        $errors['taikhoan'] = "Tồn tại";
    }
    $kq = 0;
    if(!$errors){
        $sql = "INSERT INTO `khachhang`(`username`, `password`, `email`) VALUES (:username,:password,:email)";
        $query = $conn->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        if($conn->lastInsertId()){
            echo '<div style="color:#006400;font-weight:bold" >Đăng ký thành công</div>';
        }
        
    }else{
        echo '<div style="color:red;font-weight:bold">Đăng ký thất bại</div>';
    }
    
 ?>