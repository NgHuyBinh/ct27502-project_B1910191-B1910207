<?php 
require_once 'config.php';
    if(isset($_POST['dangnhap'])){
        if(isset($_POST['admin'])){
            
            $username = $password='';
            if(isset($_POST['username1'])){
                $username = $_POST['username1'];
            }
            if(isset($_POST['password1'])){
                $password = $_POST['password1'];
            }
            
            // fix SQL Injection
            $username = str_replace('\'','\\\'',$username);
            $password = str_replace('\'','\\\'',$password);


            $errors = array();
            if($username == ''){
                $errors['username']="<div class='text-danger'><b>Bạn chưa nhập email của admin!</b></div>";
            }
            if($password == ''){
                $errors['password']="<div class='text-danger'><b>Bạn chưa nhập mật khẩu của admin!</b></div>";
            }
            $password = md5($password);
            $password = $password;

            if(!$errors){
                $sql = "SELECT * from admin where username= ? and password=?";
                $query = $conn->prepare($sql);
        
                $query->execute([$username,$password]);
                if($query->rowCount()>0){
                    
                    $_SESSION['admin']=$username;
                   
                    header("location: admin/index.php");
                }
                else{
                    echo "<script>alert('Đăng nhập thất bại rồi nha')</script>";
                }
            }else{echo "<script>alert('Đăng nhập thất bại rồi nha')</script>";
                
            }
        }else{
            $username = $password='';
            if(isset($_POST['username1'])){
                $username = $_POST['username1'];
            }
            if(isset($_POST['password1'])){
                $password = $_POST['password1'];
            }
            
            $password = md5($password);
            $sql = "SELECT * FROM khachhang where username = ? and password = ?";

            $query = $conn->prepare($sql);
            
                $query->execute([$username,$password]);
                $res = $query->fetchAll(PDO::FETCH_OBJ);

            
            if($query->rowCount()>0){
                $_SESSION['username'] = $username;
                header('location: index.php');
            }else{
                $errors['dangnhap'] = '<div style="color:red;font-weight:bold;">Đăng nhập thất bại</div>';
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in and Sign up Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        

        $(document).ready(function () {
            $("#username2").on('input',function(){
                var username = $(this).val();
                $.ajax({
                    url: "ajax/xulyinput.php",
                    type: "POST",
                    data: {username:username},
                    success: function(data){
                        if(data == 1){
                            $("#checktk").html("Tài khoản đã tồn tại");
                        }else{
                            $("#checktk").html("");
                        }
                    }
                })
            })
                            $("#dangky2").on('click',function(e){
                                e.preventDefault();
                                
                                    var username = $("#username2").val();
                                    var password = $("#password2").val();
                                    var email = $("#email2").val();

                                    $.ajax({
                                        url: "ajax/xulydangky.php",
                                        type: "POST",
                                        data: {username:username,password:password,email:email},
                                        success: function(data){
                                            $("#trangthaidangky").html(data);
                                            
                                            
                                            
                                        }
                                    })
                                
                            })

            
            
            
        });
    </script>
    <link rel="stylesheet" href="css/login1.css">
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" class="sign-in-form">
                    <h2 class="title">Đăng nhập</h2>
                    <?php
                        if(isset($errors['dangnhap'])){
                            echo $errors['dangnhap'];
                            unset($errors['dangnhap']);
                        }

                    ?>
                    <div class="input-field">
                        <i class="fas fa-user">

                        </i>
                        <input type="text" placeholder="Username" name="username1">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock">

                        </i>
                        <input type="password" placeholder="Password" name="password1">
                    </div>
                    <input type="submit" class="btn solid" name="dangnhap" value="Đăng nhập">
                    Check vào đây, nếu là admin<input type="checkbox" name="admin">
                    <p class="social-text">Hoặc đăng nhập với</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="signup-signup">
                <form method ="POST" class="sign-up-form" id="form-dang-ky">
                    <h2 class="title">Đăng ký</h2>
                    <div class="input-field">
                        <i class="fas fa-user">

                        </i>
                        <input type="text" placeholder="Username" id="username2" required>
                    </div>
                    <div style="color:red;font-weight:bold" id="checktk">
                        
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope">

                        </i>
                        <input type="email" placeholder="Email" id="email2" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock">

                        </i>
                        <input type="password" placeholder="Password" id="password2" required>
                    </div>
                    <div id="trangthaidangky">

                    </div>
                    
                    <input type="submit" class="btn solid" value="Đăng ký" id="dangky2">
                    <p class="social-text">Hoặc đăng ký với</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Đăng Ký</h3>
                    <p>
                        Nếu chưa có tài khoản, bạn có thể đăng ký tài khoản tại đây
                    </p>
                    <button class="btn transparent" id="sign-up-button">Đăng Ký</button>
                </div>
                <img src="images/workers3.png" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Đăng Nhập</h3>
                    <p>
                        Nếu có tài khoản, hãy đăng nhập tại đây
                    </p>
                    <button class="btn transparent" id="sign-in-button">Đăng Nhập</button>
                </div>
                <img src="images/workers5.png" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>