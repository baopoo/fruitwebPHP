<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();
    if($_SESSION['chucvu'] != 'Admin'){
        header('Location:admin.php');
    }
    if(isset($_POST['themnv']) && $_POST['themnv']){
        $msnv = $_POST['manhanvien'];
        $tennv = $_POST['tennhanvien'];
        $chucvu = $_POST['chucvu'];
        $diachi = $_POST['diachi'];
        $sodienthoai = $_POST['sodienthoai'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];
        // echo 'select * from nhanvien where email = \''.$email.'\'';
        $checkemail = executeSingleResult('select * from nhanvien where email = \''.$email.'\'');
        if($checkemail != NULL){
            echo '
            <div class="notifly" style="display:flex;">
                <div class="custom-alert check-order">
                    <i class="ti-info"></i>
                    <p>Email '.$email.' đã tồn tại !!</p>
                </div>
            </div>
            <script>
                const tbthemloaihanghoa = document.querySelector(".notifly")
                    setTimeout(function() {
                        tbthemloaihanghoa.style.display = "none";
                    },1500)
            </script>
            ';
        }
        else{
            // echo 'insert into nhanvien values('.$msnv.',\''.$tennv.'\',\''.$chucvu.'\', \''.$diachi.'\',\''.$sodienthoai.'\', \''.$email.'\',\''.$matkhau.'\')';
            execute('insert into nhanvien values('.$msnv.',\''.$tennv.'\',\''.$chucvu.'\', \''.$diachi.'\',\''.$sodienthoai.'\', \''.$email.'\',\''.$matkhau.'\')');
            echo '
            <div class="notifly" style="display:flex;">
                <div class="custom-alert check-order">
                    <i class="ti-check"></i>
                    <p>Thêm nhân viên thành công !!</p>
                </div>
            </div>
            <script>
                const tbthemloaihanghoa = document.querySelector(".notifly")
                    setTimeout(function() {
                        tbthemloaihanghoa.style.display = "none";
                    },1500)
            </script>
            ';
        }
    }
    if(isset($_POST['capnhatnv']) && $_POST['capnhatnv']){
        $msnv = $_POST['manhanvien'];
        $tennv = $_POST['tennhanvien'];
        $chucvu = $_POST['chucvu'];
        $diachi = $_POST['diachi'];
        $sodienthoai = $_POST['sodienthoai'];
        $email = $_POST['email'];
        $matkhau = $_POST['matkhau'];
        // echo 'select * from nhanvien where email = \''.$email.'\'';
        $checkemail = executeSingleResult('select * from nhanvien where email = \''.$email.'\' and msnv not in('.$msnv.')');
        if($checkemail != NULL){
            sleep(1);
            echo '
            <script>
            alert("Email '.$email.' đã tồn tại !!");
            window.location.href = "quanlynhanvien.php";
            </script>
            ';
        }
        else{
            // echo 'update nhanvien set hotennv =\''.$tennv.'\' , chucvu = \''.$chucvu.'\', diachi =  \''.$diachi.'\' , sodienthoai = \''.$sodienthoai.'\', email = \''.$email.'\', matkhau = \''.$matkhau.'\' where msnv = '.$msnv.'';
            execute('update nhanvien set hotennv =\''.$tennv.'\' , chucvu = \''.$chucvu.'\', diachi =  \''.$diachi.'\' , sodienthoai = \''.$sodienthoai.'\', email = \''.$email.'\', matkhau = \''.$matkhau.'\' where msnv = '.$msnv.'');
            sleep(1);
            
            // header('Location:quanlynhanvien.php');
            echo '
            <script>
                alert("Cập nhật thành công");
                window.location.href = "quanlynhanvien.php";
            </script>
            ';
        }
    }

    if(isset($_GET['capnhatmsnv'])){
        $chucvunv='';
        $chucvuad='';
        $msnv = $_GET['capnhatmsnv'];
        $getnv = executeSingleResult('select * from nhanvien where msnv='.$msnv.'');
        if($getnv['chucvu'] == 'Nhân viên'){
            $chucvunv = 'selected="selected"';
        }
        else{
            $chucvuad = 'selected="selected"';
        }
        echo'
        <div class="notifly-addnew" style="display:flex">
            <div class="notifly-content addnhanvien">
                <h3>Thêm nhân viên</h3>
                <form action="" method="post" autocomplete="off">
                    <div class="form__group field ">
                        <input type="input" class="form__field" name="manhanvien" placeholder="Mã nhân viên" value="'.$getnv['msnv'].'" readonly />
                        <label for="name" class="form__label">Mã nhân viên</label>
                    </div>
                    <div class="form__group field ">
                        <input type="input" class="form__field" name="tennhanvien" placeholder="Tên nhân viên" value="'.$getnv['hotennv'].'" required/>
                        <label for="name" class="form__label">Tên nhân viên</label>
                    </div>
                    <div class="form__group field ">
                        <!-- <input type="input" class="form__field" name="chucvu" placeholder="Chức vụ" value="'.$getnv['chucvu'].'" require/> -->
                        <select name="chucvu" class="form__field" style="width:200px">
                            <option '.$chucvunv.'>Nhân viên</option>
                            <option '.$chucvuad.'>Admin</option>
                        </select>
                        <label for="name" class="form__label">Chức vụ</label>
                    </div>
                    <div class="form__group field ">
                        <input type="input" class="form__field" name="diachi" placeholder="Địa chỉ" value="'.$getnv['diachi'].'" />
                        <label for="name" class="form__label">Địa chỉ</label>
                    </div>
                    <div class="form__group field ">
                        <input type="input" class="form__field" name="sodienthoai" pattern="(\+84|0)\d{9,10}" placeholder="Số điện thoại" value="'.$getnv['sodienthoai'].'" required/>
                        <label for="name" class="form__label">Số điện thoại</label>
                    </div>
                    <div class="form__group field ">
                        <input type="input" class="form__field" name="email" placeholder="Email" value="'.$getnv['email'].'" title="Email đăng ký phải có đuôi @gmail.com !" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/>
                        <label for="name" class="form__label">Email</label>
                    </div>
                    <div class="form__group field ">
                        <input type="password" class="form__field" name="matkhau" placeholder="Mật khẩu" value="'.$getnv['matkhau'].'" required/>
                        <label for="name" class="form__label">Mật khẩu</label>
                    </div>
                    <div class="notifly-button">
                        <input type="submit" class="inputsubmit" name="capnhatnv" value="Cập nhật">
                        <input type="button" value="Đóng" class="inputsubmit" id="dongthemnv" name="dongthemnv">
                    </div>
                </form>
            </div>
        </div>
        <script>
                document.getElementById("dongthemnv").addEventListener("click",function(){
                document.querySelector(".notifly-addnew").style.display="none"
            })
            
        </script>
        ';
    }

    if(isset($_GET['xoamsnv']) && $_GET['xoamsnv']){
        $msnv = $_GET['xoamsnv'];
        $getcv = executeSingleResult('select * from nhanvien where msnv = '.$msnv.'');
        $cv = $getcv['chucvu'];
        $getsddh= executeSingleResult('select * from dathang where msnv = '.$msnv.'');
        if($getsddh != NULL){
            execute('delete from dathang where sodondh = '.$getsddh['sodondh'].'');
            execute('delete from chitietdathang where sodondh = '.$getsddh['sodondh'].'');
        }
        // echo 'delete from khachhang where mskh = '.$mskh.'';
        execute('delete from nhanvien where msnv = '.$msnv.'');
        echo '
        <script>
            setTimeout(function(){
                alert("Đã xóa '.$cv.' '.$msnv.'");
            },1000)
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
    <div class="main">
        <?php include('nav.php'); ?>
        <div class="container">
            <div class="container-menu">
                <ul class="catalogy">
                    <li>
                        <a href="admin.php" class="active" >
                            <i class="ti-shopping-cart"></i>
                            <p>Quản lý đơn đặt hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlylhh.php" class="active" >
                            <i class="ti-agenda"></i>
                            <p>Quản lý loại hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlyhanghoa.php" class="active" >
                            <i class="ti-receipt"></i>
                            <p>Quản lý hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlykhachhang.php" class="active" >
                            <i class="ti-user"></i>
                            <p>Quản lý khách hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlynhanvien.php" class="active" style="color: var(--main-color); background-color:#fff;">
                            <i class="ti-view-list"></i>
                            <p>Quản lý nhân viên</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="container-main">
                <div class="container-operation">
                    <div class="container-link">
                        <a href="">Trang chủ</a>
                        <i>></i>
                        <p>Quản lý khách hàng</p>
                    </div>
                    <div class="container-loc">
                        <form action="" method="post" autocomplete="off">
                            <i>Lọc theo : </i>
                            <select id="label" placeholder="Tất cả" name="mucluc">
                                    <option value="Tất cả">Tất cả</option>
                                    <option value="msnv">Mã nhân viên</option>
                                    <option value="hotennv">Tên nhân viên</option>
                                    <option value="diachi">Địa chỉ</option>
                                    <option value="sodienthoai">Số điện thoại</option>
                                    <option value="chucvu">Chức vụ</option>
                                    <option value="email">Email</option>
                            </select>
                            <input type="input" list="giatri" placeholder="Giá trị" name="giatri">
                                <!-- <datalist id="giatri">
                                    <option value="Edge">
                                    <option value="Firefox">
                                    <option value="Chrome">
                                    <option value="Opera">
                                    <option value="Safari">
                                </datalist> -->
                            <input type="submit" placeholder="Tất cả" class="inputsubmit"name="loc" value="Lọc">
                        </form>
                    </div>
                    <div class="container-addnew">
                        <input type="button" id="themnv" value="Thêm" class="inputsubmit">
                    </div>
                </div>
                <div class="container-order">
                    <div class="container-order-title">
                        <div class="container-customer-code">
                            Mã nhân viên
                        </div>
                        <div class="container-customer-name">
                            Tên nhân viên
                        </div>
                        <div class="container-customer-namecty">
                            Địa chỉ
                        </div>
                        <div class="container-customer-sdt">
                            Số điện thoại
                        </div>
                        <div class="container-customer-sofax">
                            Chức vụ
                        </div>
                        <div class="container-customer-email">
                            Email
                        </div>
                        <div class="container-customer-button">

                        </div>
                    </div>
                    <?php
                        if(isset($_POST['loc']) && ($_POST['loc'])){
                            $mucluc = $_POST['mucluc'];
                            // echo $mucluc;
                            $giatri = $_POST['giatri'];
                            // switch ($mucluc){
                            //     case 'Mã nhân viên':
                            //         $loctheo = 'msnv';
                            //         break;
                            //     case 'Tên nhân viên':
                            //         $loctheo = 'hotennv';
                            //         break;
                            //     case 'Địa chỉ':
                            //         $loctheo = 'diachi';
                            //         break;
                            //     case 'Số điện thoại':
                            //         $loctheo = 'sodienthoai';
                            //         break;
                            //     case 'Chức vụ':
                            //         $loctheo = 'chucvu';
                            //         break;
                            //     case 'Email':
                            //         $loctheo = 'email';
                            //         break;
                                    
                            // }
                            // echo $giatri;
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from nhanvien order by msnv ';
                            }
                            else{
                                $sql = 'select * from nhanvien where '.$mucluc.' like  \'%'.$giatri.'%\' order by msnv ';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from nhanvien order by msnv ';
                        }
                        // echo $sql;

                        $result = executeResult($sql);
                        foreach($result as $row) {
                            echo '
                            <div class="container-order-items">
                                <div class="container-customer-code">
                                    '.$row['msnv'].'
                                </div>
                                <div class="container-customer-name">
                                '.$row['hotennv'].'
                                </div>
                                <div class="container-customer-namecty">
                                '.$row['diachi'].'
                                </div>
                                <div class="container-customer-sdt">
                                '.$row['sodienthoai'].'
                                </div>
                                <div class="container-customer-sofax">
                                '.$row['chucvu'].'
                                </div>
                                <div class="container-customer-email">
                                '.$row['email'].'
                                </div>
                                <div class="container-customer-button">
                                    <a href="quanlynhanvien.php?capnhatmsnv='.$row['msnv'].'"><input type="submit" name="capnhatnv" class="inputsubmit" value="Cập nhật"></a>
                                    <a href="quanlynhanvien.php?xoamsnv='.$row['msnv'].'"><input type="submit" name="xoanv" class="inputsubmit" value="Xóa"></a>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                    <!-- <div class="container-order-items">
                        <div class="container-customer-code">
                            1
                        </div>
                        <div class="container-customer-name">
                            Nguyễn Thị Thảo Trang
                        </div>
                        <div class="container-customer-namecty">
                            Công ty trách nhiệm hữu hạn 1 thành viên hút hầm cầu
                        </div>
                        <div class="container-customer-sdt">
                            0385832071
                        </div>
                        <div class="container-customer-sofax">
                            123
                        </div>
                        <div class="container-customer-email">
                            bao12@gmail.com
                        </div>
                        <div class="container-customer-button">
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Lịch sử giao dịch"></a>
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                        </div>
                    </div> -->
                    <!-- <div class="container-order-items">
                        <div class="container-customer-code">
                            1
                        </div>
                        <div class="container-customer-name">
                            Nguyễn Thị Thảo Trang
                        </div>
                        <div class="container-customer-namecty">
                            Công ty trách nhiệm hữu hạn 1 thành viên hút hầm cầu
                        </div>
                        <div class="container-customer-sdt">
                            0385832071
                        </div>
                        <div class="container-customer-sofax">
                            123
                        </div>
                        <div class="container-customer-email">
                            bao12@gmail.com
                        </div>
                        <div class="container-customer-button">
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Lịch sử giao dịch"></a>
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                        </div>
                    </div> -->
                </div>


            </div>
        </div>
    </div>
    <div class="notifly-addnew">
        <div class="notifly-content addnhanvien">
            <h3>Thêm nhân viên</h3>
            <form action="" method="post" autocomplete="off">
                <div class="form__group field ">
                    <?php
                        $gmmsnv = executeSingleResult('select max(msnv) from nhanvien');
                        if($gmmsnv['max(msnv)'] == NULL){
                            $msnv = 1;
                        }
                        else{
                            $msnv = $gmmsnv['max(msnv)'] + 1;
                        }
                    ?>
                    <input type="input" class="form__field" name="manhanvien" placeholder="Mã nhân viên" value="<?php echo $msnv ?>" readonly />
                    <label for="name" class="form__label">Mã nhân viên</label>
                </div>
                <div class="form__group field ">
                    <input type="input" class="form__field" name="tennhanvien" placeholder="Tên nhân viên" value="" required/>
                    <label for="name" class="form__label">Tên nhân viên</label>
                </div>
                <div class="form__group field ">
                    <!-- <input type="input" class="form__field" name="chucvu" placeholder="Chức vụ" value="" require/> -->
                    <select name="chucvu" class="form__field" style="width:200px">
                        <option selected="selected">Nhân viên</option>
                        <option>Admin</option>
                    </select>
                    <label for="name" class="form__label">Chức vụ</label>
                </div>
                <div class="form__group field ">
                    <input type="input" class="form__field" name="diachi" placeholder="Địa chỉ" value="" />
                    <label for="name" class="form__label">Địa chỉ</label>
                </div>
                <div class="form__group field ">
                    <input type="input" class="form__field" name="sodienthoai" pattern="(\+84|0)\d{9,10}" placeholder="Số điện thoại" value="" required/>
                    <label for="name" class="form__label">Số điện thoại</label>
                </div>
                <div class="form__group field ">
                    <input type="input" class="form__field" name="email" placeholder="Email" value="" title="Email đăng ký phải có đuôi @gmail.com !" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/>
                    <label for="name" class="form__label">Email</label>
                </div>
                <div class="form__group field ">
                    <input type="password" class="form__field" name="matkhau" placeholder="Mật khẩu" value="" required/>
                    <label for="name" class="form__label">Mật khẩu</label>
                </div>
                <div class="notifly-button">
                    <input type="submit" class="inputsubmit" name="themnv" value="Thêm">
                    <input type="button" value="Đóng" class="inputsubmit" id="dongthemnv" name="dongthemnv">
                </div>
            </form>
        </div>
    </div>
    
    <!-- <div class="notifly-lichsu" style="display:flex">
        <div class="customer-product lichsugiaodich">
            <div class="customer-product-title">
                <div class="customer-product-info">
                    <p>Sản phẩm</p>
                </div>
                <div class="customer-product-name">
                    <p>Tên sản phẩm</p>
                </div>
                <p class="customer-product-soluong">Số lượng</p>
                
                <div class="customer-product-price">
                    <p>Thành tiền</p>
                </div>
                <div class="customer-product-giamgia">
                    <p>Giảm giá</p>
                </div>
                <div class="customer-product-status">
                    <p>Trạng thái</p>
                </div>
            </div>
            <div class="customer-product-item">
                <div class="customer-product-info">
                    <div class="customer-product-img" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                </div>
                <div class="customer-product-name">
                    <p>Chôm Chôm</p>
                </div>
                <p class="customer-product-soluong">2</p>
                
                <div class="customer-product-price">
                    <p>100000<i>₫</i></p>
                </div>
                <div class="customer-product-giamgia">
                    <p>1000<i>₫</i></p>
                </div>
                <div class="customer-product-status">
                    <p>Chua duyet</p>
                </div>
            </div>
        </div>
        <i class="ti-close donglichsu" id="donglichsu"></i>
    </div> -->
    <script>
        document.getElementById("themnv").addEventListener("click",function(){
            document.querySelector(".notifly-addnew").style.display="flex"
            document.getElementById("dongthemnv").addEventListener("click",function(){
            document.querySelector(".notifly-addnew").style.display="none"
        })
        })
        
    </script>
    
</body>
</html>