<?php
require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nón Bảo Hiểm MONA</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(e){
        $("#timnonbaohiem").on('input',function(){
            var search = $(this).val();
            $.ajax({
                url: "ajax/xulysearch.php",
                type: "GET",
                data: {search:search},
                success:function(data){
                    $("#dayne").html(data);
                }
            })
        })
    })
</script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="header-1">
            <div class="items">
                <div class="item">
                    <img src="/images/logo201.png" alt="LoGo" style="width:120px;height:120px">
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="index.php">TRANG CHỦ</a></li>
                        <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
                        <li class="detail-menu">
                            <a href="nonbaohiem.php">NÓN BẢO HIỂM</a>
                        </li>
                        <li><a href="lienhe.php">LIÊN HỆ</a></li>
                        <li>
                            <?php 
                                if(isset($_SESSION['username']) ){
                                    echo '<a href="dangxuat.php">ĐĂNG XUẤT</a>';
                                }else{
                                    echo '<a href="dangnhap.php">ĐĂNG NHẬP</a>';
                                }
                                
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    