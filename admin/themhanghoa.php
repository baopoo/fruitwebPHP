<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();


    if(isset($_POST['themhanghoa']) && $_POST['themhanghoa']){
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
        $sql = 'insert into hanghoa values('.$masp.',\''.$tensp.'\' ,\''.$quycach.'\' ,\''.$mota.'\' ,'.$gia.' , '.$soluong.' ,'.$maloaihang.' ,'.$hot.')';
        // echo $sql;
        $co = 0;
        for( $i = 0; $i < 4 ; $i++) {
            $check = getimagesize($_FILES["anhsanpham$i"]["tmp_name"]);
            if($check !== false){
                $co =  1;
            }
            else {
                $co = 0;
                echo '
                <script>
                    alert("Vui lòng chọn đúng file là ảnh !");
                </script>
                ';
                break;
            }
        }
        $target_dir = "../anhsanpham/";
        
        if($co == 1){
            execute($sql);
            for( $i = 0; $i < 4 ; $i++) {
                $gmhhh = executeSingleResult('select max(mahinh) from hinhhanghoa');
                if($gmhhh['max(mahinh)'] == NULL){
                    $mahinh = 1;
                }
                else{
                    $mahinh = $gmhhh['max(mahinh)'] + 1;
                }
                // echo 'insert into hinhhanghoa values('.$mahinh.',\''.$_FILES["anhsanpham$i"]['name'].'\','.$masp.')';
                execute('insert into hinhhanghoa values('.$mahinh.',\''.$_FILES["anhsanpham$i"]['name'].'\','.$masp.')');
                // echo "Đây là file ảnh - " . $check["mime"] . ".";
                $co = 1;
                $target_file = $target_dir . $_FILES["anhsanpham$i"]['name'];
                if (!file_exists($target_file)) {
                    move_uploaded_file($_FILES["anhsanpham$i"]["tmp_name"], $target_file);
                    }
            }
        }
        if($co == 1){
            echo '
                <div class="notifly" style="display:flex;">
                    <div class="custom-alert check-order">
                        <i class="ti-check"></i>
                        <p>Thêm thành công</p>
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
        <div class="container-link">
            <a href="admin.php">Trang chủ</a>
            <i>></i>
            <a href="quanlyhanghoa.php"><p>Quản lý hàng hóa</p></a>
            <i>></i>
            <p style="color: var(--main-color);">Thêm hàng hóa</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="the-order">
                <div class="order-info-genaral">
                    <div class="order-info-input">
                        <h2>Thông tin sản phẩm</h2>
                            <div class="form__group field">
                                <?php
                                    $gmhh = executeSingleResult('select max(mshh) from hanghoa');
                                    if($gmhh['max(mshh)'] == NULL){
                                        $mshh = 1;
                                    }
                                    else{
                                        $mshh = $gmhh['max(mshh)'] + 1;
                                    }
                                ?>
                                <input type="input" class="form__field" name="masp"  placeholder="Mã sản phẩm" value="<?php echo $mshh ?>" readonly>
                                <label for="name" class="form__label">Mã sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field"  placeholder="Tên sản phẩm" name="tensp" value="" required />
                                <label for="name" class="form__label">Tên sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Quy cách" name="quycach" value=""  required/>
                                <label for="name" class="form__label">Quy cách</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Mô tả" name="mota" value=""  />
                                <label for="name" class="form__label">Mô tả</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Giá" name="gia" value=""  required />
                                <label for="name" class="form__label">Giá</label>
                            </div>
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="Số lượng sản phẩm" name="soluong" value=""  required />
                                <label for="name" class="form__label">Số lượng sản phẩm</label>
                            </div>
                            <div class="form__group field">
                                <!-- <input type="select" class="form__field" list="loaihang" placeholder="Tên loại hàng (chỉ chọn giá trị trong danh sách)" name="loaihang" value="<?php echo $result['tenloaihang'] ?>" required /> -->
                                <select name="loaihang" class="form__field" style="width:200px">
                                <?php
                                    $rs = executeResult('select * from loaihanghoa');
                                    foreach ($rs as $row) {
                                            echo '
                                            <option>'.$row['tenloaihang'].'</option>
                                            ';
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
                                    <option>1</option>
                                    <option selected="selected" >0</option>
                                </select>
                                <!-- <input type="input" name="noibat" class="form__field" list="noibat" placeholder="Nổi bật" value=""> -->
                                <!-- <input type="input" class="form__field" list="noibat" placeholder="Nổi bật" value="" name="hot" require /> -->
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
                            for( $i = 0; $i < 4;  $i++){
                                echo'
                                    <div class="product-info-imgs">
                                        <div class="product-imgs"  id="product-imgs" style="background-image: url()"></div>    
                                        <input type="file" class="product-detail-btn btn-add" name="anhsanpham'.$i.'" required title="Chọn file ảnh sản phẩm!" >
                                        <input type="button" class="product-detail-btn btn-buy" value="Xóa" id="xoaanh'.$i.'" >
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
                <input type="submit" class="product-detail-btn btn-add" name="themhanghoa" value="Thêm">
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
        document.querySelectorAll(".order-info-input input[type='button']").forEach(function(input){
            input.addEventListener("click",function(e){
                // console.log(e.target.parentNode.children[1]);
                // console.log('1');
                e.target.parentNode.children[1].value ="";
                e.target.parentNode.children[0].style.backgroundImage = `url()`;
            });
        })
    </script>
</body>
</html>