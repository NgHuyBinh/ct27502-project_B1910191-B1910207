<?php include('header.php') ;
    if(!isset($_SESSION['admin'])){
        header('location: ../dangnhap.php');
    }
?>
<br><br><br>
<div class="container show_admin">
    <h2 class="text-center mt-4" style="background-color:#FFEFD5;">Danh sách nón bảo hiểm</h2>
            <?php 
                
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
    <div class="text-center">
        <table class="table table-bordered">
            <thead>
                <th>STT</th>
                <th>Tiêu đề</th>
                
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Nổi bật</th>
                
                <th>Lựa chọn</th>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT * FROM non";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $rows = $query->fetchAll(PDO::FETCH_OBJ);

                    $index = 0;
                    if($conn->query($sql)==true){
                        foreach ($rows as $row){
                            $index++;
                            $id = htmlentities($row->id);
                        $tieude = htmlentities($row->tieude);
                       
                        $gia = htmlentities($row->gia);
                        $hinhanh = htmlentities($row->hinhanh);
                        $noibat = htmlentities($row->noibat);
                            
                            ?>
                                <tr>
                                    <td><?php echo $index?></td>
                                    <td><?php echo $tieude?></td>
                                    
                                    <td><?php echo $gia."đ"?></td>
                                    <td>
                                    <?php
                                        if($hinhanh !=''){
                                            ?>
                                            <img src="../images/<?php echo $hinhanh;?>" style="width:100px;" >
                                            <?php
                                        }else{
                                            echo "<div class='text-danger mb-3 text-center'><b>Không có hình ảnh hiển thị</b></div>";
                                        }
                                    ?>
                                    </td>
                                    <td><?php echo $noibat?></td>
                                    

                                    <td style=""><a href="edit.php?id=<?php echo $id ?>" class="btn btn-warning" style="font-size:120%">Chỉnh sửa</a>
                                    <a href="delete.php?id=<?php echo $id ?>" class="btn btn-danger" style="font-size:120%">Xóa</a>
                                </td>
                                </tr>
                                
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <a href="them.php" class="btn" style="font-size:100%; background-color: #e99714;">Thêm nón bảo hiểm</a>
</div>

<?php include('../footer.php') ?>