<?php
    include('../config.php');
    if(!isset($_SESSION['admin'])){
        header('location: ../dangnhap.php');
    }
    if(isset($_GET['id'])){
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
        $sql = "DELETE FROM non where id =?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);

        $_SESSION['delete'] = "<div class='text-success mb-3'><b> Xóa nón bảo hiểm thành công!</b></div>";
        header('location: index.php');
    }else{
        header('location: index.php');
            die();
    }
?>