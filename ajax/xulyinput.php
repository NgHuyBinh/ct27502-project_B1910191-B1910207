<?php
    require_once '../config.php';
    $kq = 0;
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $sql = "SELECT * FROM khachhang where username =:username";
        $query = $conn->prepare($sql);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->execute();

        if($query->rowCount()>0){
            $kq = 1;
        }else{
            $kq = 0;
        }
    }echo $kq;
 ?>