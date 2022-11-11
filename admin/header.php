<?php
require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống MoNa</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    
</script>
    <link rel="stylesheet" href="http://ct275-project.localhost/css/style.css">
</head>
<body>
    <header>
        <div class="header-1">
            <div class="items">
                <div class="item">
                    <img src="http://ct275-project.localhost/images/logo201.png" alt="LoGo" style="width:120px;height:120px">
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <?php 
                                if(isset($_SESSION['admin']) ){
                                    echo '<a href="../dangxuat.php">ĐĂNG XUẤT</a>';
                                }else{
                                    echo '<a href="../dangnhap.php">ĐĂNG NHẬP</a>';
                                }
                                
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    