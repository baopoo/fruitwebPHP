<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();

    if(!isset($_GET['mshh'])){
        header('location:quanlyhanghoa.php');
    }

    if(isset($_POST['capnhathanghoa']) && $_POST['capnhathanghoa']){
        $masp = $_POST['masp'];
        // echo $masp;
        $tensp = $_POST['tensp'];
        // echo $tensp;
        $quycach = $_POST['quycach'];
        // echo $quycach;
        $mota = $_POST['mota'];
        // echo $mota;
        $gia = $_POST['gia'];
        // echo $gia;
        $soluong = $_POST['soluong'];
        // echo $soluong;
        $tenloaihang = $_POST['loaihang'];
        $getmlh = executeSingleResult('select * from loaihanghoa where tenloaihang = \''.$tenloaihang.'\'');
        $maloaihang = $getmlh['maloaihang'];
        // echo $tenloaihang;
        $hot = $_POST['noibat'];
        // echo 'update hanghoa set tenhh=\''.$tensp.'\' , quycach=\''.$quycach.'\' , mota =\''.$mota.'\' , gia ='.$gia.' , soluonghang ='.$soluong.' , maloaihang ='.$maloaihang.' , hot = '.$hot.'';
        // echo $hot;
        // $anhsp1 = $_FILES['anhsanpham0']['name'];
        // // echo $anhsp1;
        // $anhsp2 = $_FILES['anhsanpham1']['name'];
        // // echo $anhsp2;
        // $anhsp3 = $_FILES['anhsanpham2']['name'];
        // // echo $anhsp3;
        // $anhsp4 = $_FILES['anhsanpham3']['name'];
        $target_dir = "../anhsanpham/";
        $co = 0;
        for($i = 0; $i < 4;  $i++) {
            // echo $_POST["mahinh$i"];
            if($_FILES["anhsanpham$i"]['name'] != ''){
                // echo $_FILES["anhsanpham$i"]['name'];
                $check = getimagesize($_FILES["anhsanpham$i"]["tmp_name"]);
                    if($check !== false){
                        execute('update hinhhanghoa set tenhinh =\''.$_FILES["anhsanpham$i"]['name'].'\' where mahinh='.$_POST["mahinh$i"].'');
                        
                            $target_file = $target_dir . $_FILES["anhsanpham$i"]['name'];
                            if (!file_exists($target_file)) {
                                move_uploaded_file($_FILES["anhsanpham$i"]["tmp_name"], $target_file);
                            }
                            echo '
                            <div class="notifly" style="display:flex;">
                                <div class="custom-alert check-order">
                                    <i class="ti-check"></i>
                                    <p>Cập nhập thành công</p>
                                </div>
                            </div>
                            <script>
                                const tbthemloaihanghoa = document.querySelector(".notifly")
                                    setTimeout(function() {
                                        window.location.href="quanlyhanghoa.php"
                                    },1500)
                            </script>
                            ';
                    }
                    else {
                        echo '<script>alert("Vui lòng chọn đúng file ảnh !")</script>';
                        break;
                    }
            }
        }
        execute('update hanghoa set tenhh=\''.$tensp.'\' , quycach=\''.$quycach.'\' , mota =\''.$mota.'\' , gia ='.$gia.' , soluonghang ='.$soluong.' , maloaihang ='.$maloaihang.' , hot = '.$hot.' where mshh='.$masp.'');

        //     if(isset($_POST['mahinh0'])){
        //         $mahinh1 = $_POST['mahinh0'];
        //         if($anhsp1 != ''){
        //             $check = getimagesize($_FILES["anhsanpham0"]["tmp_name"]);
        //             if($check !== false){
        //             // echo 'update hinhhanghoa set tenhinh =\''.$anhsp1.'\' where mahinh='.$mahinh1.'';
        //                 execute('update hinhhanghoa set tenhinh =\''.$anhsp1.'\' where mahinh='.$mahinh1.'');
        //                 $target_file = $target_dir . $anhsp1;
        //                 if (!file_exists($target_file)) {
        //                     move_uploaded_file($_FILES["anhsanpham0"]["tmp_name"], $target_file);
        //                 }
        //             }
        //         }
        //     }
        //     else{
        //         if($anhsp1 != ''){
        //             $gmhhh = executeSingleResult('select max(mahinh) from hinhhanghoa');
        //             if($gmhhh['max(mahinh)'] == NULL){
        //                 $mahinh = 1;
        //             }
        //             else{
        //                 $mahinh = $gmhhh['max(mahinh)'] + 1;
        //             }
        //             // echo 'insert into hinhhanghoa values('.$mahinh.',\''.$anhsp1.'\','.$masp.')';
        //             execute('insert into hinhhanghoa values('.$mahinh.',\''.$anhsp1.'\','.$masp.')');
        //             $target_file = $target_dir . $anhsp1;
        //             if (!file_exists($target_file)) {
        //                 move_uploaded_file($_FILES["anhsanpham0"]["tmp_name"], $target_file);
        //             }
        //         }

        //     }
        // if(isset($_POST['mahinh1'])){
        //     $mahinh2 = $_POST['mahinh1'];
        //     if($anhsp2 != ''){
        //         // echo 'update hinhhanghoa set tenhinh =\''.$anhsp2.'\' where mahinh='.$mahinh2.'';
        //         execute('update hinhhanghoa set tenhinh =\''.$anhsp2.'\' where mahinh='.$mahinh2.'');
        //     }
        //     $target_file = $target_dir . $anhsp2;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham1"]["tmp_name"], $target_file);
        //           }
        // }
        // else{
        //     if($anhsp2 != ''){
        //         $gmhhh = executeSingleResult('select max(mahinh) from hinhhanghoa');
        //         if($gmhhh['max(mahinh)'] == NULL){
        //             $mahinh = 1;
        //         }
        //         else{
        //             $mahinh = $gmhhh['max(mahinh)'] + 1;
        //         }
        //         // echo 'insert into hinhhanghoa values('.$mahinh.',\''.$anhsp2.'\','.$masp.')';
        //         execute('insert into hinhhanghoa values('.$mahinh.',\''.$anhsp2.'\','.$masp.')');
        //         $target_file = $target_dir . $anhsp2;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham1"]["tmp_name"], $target_file);
        //           }
        //     }

        // }
        // if(isset($_POST['mahinh2'])){
        //     $mahinh3 = $_POST['mahinh2'];
        //     if($anhsp3 != ''){
        //         // echo 'update hinhhanghoa set tenhinh =\''.$anhsp3.'\' where mahinh='.$mahinh3.'';
        //         execute('update hinhhanghoa set tenhinh =\''.$anhsp3.'\' where mahinh='.$mahinh3.'');
        //         $target_file = $target_dir . $anhsp3;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham2"]["tmp_name"], $target_file);
        //           }
        //     }
        // }
        // else{
        //     if($anhsp3 != ''){
        //         $gmhhh = executeSingleResult('select max(mahinh) from hinhhanghoa');
        //         if($gmhhh['max(mahinh)'] == NULL){
        //             $mahinh = 1;
        //         }
        //         else{
        //             $mahinh = $gmhhh['max(mahinh)'] + 1;
        //         }
        //         // echo 'insert into hinhhanghoa values('.$mahinh.',\''.$anhsp3.'\','.$masp.')';
        //         execute('insert into hinhhanghoa values('.$mahinh.',\''.$anhsp3.'\','.$masp.')');
        //         $target_file = $target_dir . $anhsp3;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham2"]["tmp_name"], $target_file);
        //           }
        //     }

        // }
        // if(isset($_POST['mahinh3'])){
        //     $mahinh4 = $_POST['mahinh3'];
        //     if($anhsp4 != ''){
        //         // echo 'update hinhhanghoa set tenhinh =\''.$anhsp4.'\' where mahinh='.$mahinh4.'';
        //         execute('update hinhhanghoa set tenhinh =\''.$anhsp4.'\' where mahinh='.$mahinh4.'');
        //         $target_file = $target_dir . $anhsp4;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham3"]["tmp_name"], $target_file);
        //           }
        //     }
        // }
        // else{
        //     if($anhsp4 != ''){
        //         $gmhhh = executeSingleResult('select max(mahinh) from hinhhanghoa');
        //         if($gmhhh['max(mahinh)'] == NULL){
        //             $mahinh = 1;
        //         }
        //         else{
        //             $mahinh = $gmhhh['max(mahinh)'] + 1;
        //         }
        //         // echo 'insert into hinhhanghoa values('.$mahinh.',\''.$anhsp4.'\','.$masp.')';
        //         execute('insert into hinhhanghoa values('.$mahinh.',\''.$anhsp4.'\','.$masp.')');
        //         $target_file = $target_dir . $anhsp4;
        //         if (!file_exists($target_file)) {
        //             move_uploaded_file($_FILES["anhsanpham3"]["tmp_name"], $target_file);
        //           }
        //     }

        // }
        echo '
        <div class="notifly" style="display:flex;">
            <div class="custom-alert check-order">
                <i class="ti-check"></i>
                <p>Cập nhập thành công</p>
            </div>
        </div>
        <script>
            const tbthemloaihanghoa = document.querySelector(".notifly")
                setTimeout(function() {
                    window.location.href="quanlyhanghoa.php"
                },1500)
        </script>
        ';
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <div class="container container-viewdetail">
            <?php
                if(isset($_GET['mshh'])){
                    $mshh = $_GET['mshh'];
                    // echo $mshh;
                    $getinfo = 'select * from hanghoa h join loaihanghoa lh on h.maloaihang = lh.maloaihang where h.mshh = '.$mshh.'';
                    // echo $getinfo;
                    $result = executeSingleResult($getinfo); 
                    echo'
                    
                    ';
                }

            ?>
        <div class="container-link">
            <a href="admin.php">Trang chủ</a>
            <i>></i>
            <a href="quanlyhanghoa.php"><p>Quản lý hàng hóa</p></a>
            <i>></i>
            <p style="color: var(--main-color);"><?php echo $result['mshh'] ?></p>
        </div>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="the-order">
                <div class="order-info-genaral">
                    <div class="order-info-input">
                        <h2>Thông tin sản phẩm</h2>
                            <div class="form__group field">
                                <input type="input" class="form__field" name="masp"  placeholder="Mã sản phẩm" value="<?php echo $result['mshh'] ?>" readonly>
                                <label for="name" class="form__label">Mã sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field"  placeholder="Tên sản phẩm" name="tensp" value="<?php echo $result['tenhh'] ?>" required />
                                <label for="name" class="form__label">Tên sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Quy cách" name="quycach" value="<?php echo $result['quycach'] ?>"  required/>
                                <label for="name" class="form__label">Quy cách</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Mô tả" name="mota" value="<?php echo $result['mota'] ?>"  />
                                <label for="name" class="form__label">Mô tả</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Giá" name="gia" value="<?php echo $result['gia'] ?>"  required />
                                <label for="name" class="form__label">Giá</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Số lượng sản phẩm" name="soluong" value="<?php echo $result['soluonghang'] ?>"  required />
                                <label for="name" class="form__label">Số lượng sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <!-- <input type="select" class="form__field" list="loaihang" placeholder="Tên loại hàng (chỉ chọn giá trị trong danh sách)" name="loaihang" value="<?php echo $result['tenloaihang'] ?>" required /> -->
                                <select name="loaihang" class="form__field" style="width:200px">
                                <?php
                                    $rs = executeResult('select * from loaihanghoa');
                                    foreach ($rs as $row) {
                                        if($row['tenloaihang'] == $result['tenloaihang']){
                                            echo'
                                            <option selected="selected">'.$row['tenloaihang'].'</option>
                                            ';

                                        }else{
                                            echo '
                                            <option>'.$row['tenloaihang'].'</option>
                                            ';
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="name" class="form__label">Tên loại hàng</label>
                                <!-- <datalist id="loaihang"> -->
                                    
                                    
                                    <!-- <option value="Rau củ"></option> -->
                                <!-- </datalist> -->
                                <!-- <label for="name" class="form__label">Tên loại hàng</label>
                                <select name="" id="" value="Rau củ" style="width:200px" class="form__field" >
                                    <option value="Trái cây" >Trái cây</option>
                                    <option value="Trái cây" >Trái cây</option>
                                </select> -->
                            </div>
                            <div class="form__group field">
                                <select name="noibat" class="form__field" style="width:200px">
                                    <?php
                                        if($result['hot'] == '1'){
                                            echo'
                                                <option selected="selected" >1</option>
                                                <option >0</option>
                                            ';
                                        }
                                        else{
                                            echo '
                                                <option selected="selected" >0</option>
                                                <option >1</option>
                                            ';
                                        }
                                    ?>
                                </select>
                                <!-- <input type="input" name="noibat" class="form__field" list="noibat" placeholder="Nổi bật" value="<?php echo $result['hot'] ?>"> -->
                                <!-- <input type="input" class="form__field" list="noibat" placeholder="Nổi bật" value="<?php echo $result['hot'] ?>" name="hot" require /> -->
                                <label for="name" class="form__label">Nổi bật (Chọn dưới)</label>
                                <!-- <datalist id="noibat">
                                    <option value="1"></option>
                                    <option value="0"></option>
                                </datalist> -->
                            </div>
                    </div>
                </div>
                <div class="order-info-customer">
                    <div class="order-info-input">
                        <h2>Ảnh sản phẩm</h2>
                        <?php
                            if(isset($_GET['mshh'])){
                                $mshh = $_GET['mshh'];
                                // echo $mshh;
                                $getinfo = 'select * from hanghoa h join hinhhanghoa hh on h.mshh = hh.mshh where h.mshh = '.$mshh.'';
                                // echo $getinfo;
                                $result = executeResult($getinfo);
                            }
                            for( $i = 0; $i < 4;  $i++){
                                    // echo $result[$i]['tenhinh'];
                                    echo'
                                    <div class="product-info-imgs">
                                        <div class="product-imgs"  id="product-imgs" style="background-image: url(../anhsanpham/'.$result[$i]['tenhinh'].')"></div>    
                                        <input type="file" class="product-detail-btn btn-add" name="anhsanpham'.$i.'" >
                                        <input type="input" hidden class="product-detail-btn" name="mahinh'.$i.'" value="'.$result[$i]['mahinh'].'" >
                                    </div>
                                ';
                            }
            
                        ?>

                            <!-- <div class="product-info-imgs">
                                <div class="product-imgs" id="product-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg)"></div>    
                                <input type="file" name="anhsanpham" class="anhsanpham1">
                                
                            </div> -->
                            <!-- <div class="product-info-imgs">
                                <div class="product-imgs" id="product-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg)"></div>    
                                <input type="file" name="anhsanpham" class="anhsanpham1">
                                
                            </div>
                            <div class="product-info-imgs">
                                <div class="product-imgs" id="product-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg)"></div>    
                                <input type="file" name="anhsanpham" class="anhsanpham1">
                                
                            </div>
                            <div class="product-info-imgs">
                                <div class="product-imgs" id="product-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg)"></div>    
                                <input type="file" name="anhsanpham" class="anhsanpham1">
                
                            </div> -->
                    </div>
                </div>
            </div>
            <div class="product-detail-button">
                <input type="submit" class="product-detail-btn btn-add" name="capnhathanghoa" value="Cập nhật">
                <a href="quanlyhanghoa.php"><input type="button" class="product-detail-btn btn-buy" value="Trở lại"></a>
            </div>
        </form>
    </div>


    <script>
        // const file=document.getElementById("anhsanpham1");
        // console.log(file);
        // const anhsp=document.getElementById("product-imgs");
        // file.addEventListener("change", function(e){
        //     anhsp.style.backgroundImage = `url(${(window.URL || window.webkitURL).createObjectURL(e.target.files[0])})`;
        //     console.log((window.URL || window.webkitURL).createObjectURL(e.target.files[0]));
        // });
        document.querySelectorAll(".order-info-input input[type='file']").forEach(function(input){
            input.addEventListener("change",function(e){
                // console.log(e.target.parentNode.children[1]);
                // console.log('1');
                e.target.parentNode.children[0].style.backgroundImage = `url(${(window.URL || window.webkitURL).createObjectURL(e.target.files[0])})`;
            });
        })
    </script>
</body>
</html>