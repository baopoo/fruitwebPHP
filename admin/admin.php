<?php
    include('DBHelper.php');
    session_start();
    // echo $_SESSION['chucvu'];
    if(isset($_POST['duyet']) && $_POST['duyet']){
        $getmanv = executeSingleResult('select * from nhanvien where email = \''.$_SESSION['emailad'].'\'');
        $sql = 'update dathang set msnv = '.$getmanv['msnv'].',ngaygh = \''.date("Y-m-d").'\',trangthaidh = "da duyet" where sodondh = '.$_POST['madonhang'].'';
        // echo $sql;
        execute($sql);
        
        header('Location:xemvacapnhat.php?sodondh='.$_POST['madonhang'].'');
    }
    if(isset($_POST['themlhh']) && $_POST['themlhh']){
        echo 1;
    }

    if(isset($_GET['xoadonhang']) && $_GET['xoadonhang']){
        execute('delete from chitietdathang where sodondh = '.$_GET['xoadonhang'].'');
        execute('delete from dathang where sodondh = '.$_GET['xoadonhang'].'');
        echo '
        <script>
        alert("Đã xóa đơn hàng '.$_GET['xoadonhang'].'");
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
        <!-- <div class="nav">
            <div class="nav-logo">
                <img src="./img/foodavatar1.png" width="200px" height="60px" alt="">
            </div>
            <div class="nav-main">
                <div class="nav-title">
                    <p>Food Store Manager</p>
                </div>
                <div class="nav-info">
                    <img src="./img/admin1.png" width="40px" height="40px" alt="">
                    <p>Nhân viên</p>
                    <i>Bảo</i>
                </div>
            </div>
        </div> -->
        <?php include('nav.php'); ?>


        <div class="container">
            <div class="container-menu">
                <ul class="catalogy">
                    <li>
                        <a href="admin.php" class="active" style="color: var(--main-color); background-color:#fff;">
                            <i class="ti-shopping-cart"></i>
                            <p>Quản lý đơn đặt hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlylhh.php" class="active">
                            <i class="ti-agenda"></i>
                            <p>Quản lý loại hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlyhanghoa.php" class="active">
                            <i class="ti-receipt"></i>
                            <p>Quản lý hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlykhachhang.php" class="active">
                            <i class="ti-user"></i>
                            <p>Quản lý khách hàng</p>
                        </a>
                    </li>
                    <?php
                        if($_SESSION['chucvu'] == 'Admin'){
                            echo '
                            <li>
                                <a href="quanlynhanvien.php" class="active">
                                    <i class="ti-view-list"></i>
                                    <p>Quản lý nhân viên</p>
                                </a>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
            <div class="container-main">
                <div class="container-operation">
                    <div class="container-link">
                        <a href="">Trang chủ</a>
                        <i>></i>
                        <p>Quản lý hàng hóa</p>
                    </div>
                    <div class="container-loc">
                        <form action="" method="post" autocomplete="off">
                            <i>Lọc theo : </i>
                            <select name="mucluc" id="" placeholder = "Tất cả">
                                <option value="Tất cả">Tất cả</option>
                                <option value="sodondh">Mã đơn</option>
                                <option value="mskh">Mã khách hàng</option>
                                <option value="msnv">Mã nhân viên</option>
                                <option value="ngaydh">Ngày đặt hàng</option>
                                <option value="ngaygh">Ngày giao hàng</option>
                                <option value="trangthaidh">Trạng thái</option>
                            </select>            
                                    <!-- <option value="Edge"> -->
                            <input type="input" placeholder="Giá trị" name="giatri">
                                <!-- <datalist id="giatri">
                                    <option value="Edge">
                                    <option value="Firefox">
                                    <option value="Chrome">
                                    <option value="Opera">
                                    <option value="Safari">
                                </datalist> -->
                            <input type="submit" placeholder="Tất cả" class="inputsubmit" name="loc" value="Lọc">
                        </form>
                    </div>
                    <div class="container-addnew">
                        <!-- <a href=""><input type="submit" value="Thêm" class="inputsubmit"></a> -->
                    </div>
                </div>
                <div class="container-order">
                    <div class="container-order-title">
                        <div class="container-order-code">
                            Mã đơn
                        </div>
                        <div class="container-order-code-customer">
                            Mã khách hàng
                        </div>
                        <div class="container-order-code-staff">
                            Mã nhân viên
                        </div>
                        <div class="container-order-date">
                            Ngày đặt hàng
                        </div>
                        <div class="container-order-delivery">
                            Ngày giao hàng
                        </div>
                        <div class="container-order-status">
                            Trạng thái
                        </div>
                        <div class="container-order-button">
                            
                        </div>
                    </div>
                    <?php
                        if(isset($_POST['loc']) && ($_POST['loc'])){
                            $mucluc = $_POST['mucluc'];
                            // echo $mucluc;
                            $giatri = $_POST['giatri'];
                            // echo $giatri;
                            // switch ($mucluc){
                            //     case 'Mã đơn':
                            //         $loctheo = 'sodondh';
                            //         break;
                            //     case 'Mã khách hàng':
                            //         $loctheo = 'mskh';
                            //         break;
                            //     case 'Mã nhân viên':
                            //         $loctheo = 'msnv';
                            //         break;
                            //     case 'Ngày đặt hàng':
                            //         $loctheo = 'ngaydh';
                            //         break;
                            //     case 'Ngày giao hàng':
                            //         $loctheo = 'ngaygh';
                            //         break;
                            //     case 'Trạng thái':
                            //         $loctheo = 'trangthaidh';
                            //         break;
                                    
                            // }
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from dathang order by sodondh desc';
                            }
                            else{
                                $sql = 'select * from dathang where '.$mucluc.' like  \'%'.$giatri.'%\' order by sodondh desc';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from dathang order by sodondh desc';
                        }
                        // echo $sql;
                        $ketqua = executeResult($sql);
                        foreach($ketqua as $item) {

                    ?>
                            <div class="container-order-items">
                                <div class="container-order-code">
                                   <?php echo $item['sodondh'] ?>
                                </div>
                                <div class="container-order-code-customer">
                                    <?php echo $item['mskh'] ?>
                                </div>
                                <div class="container-order-code-staff">
                                    <?php echo $item['msnv'] ?>
                                </div>
                                <div class="container-order-date">
                                    <?php echo $item['ngaydh'] ?>
                                </div>
                                <div class="container-order-delivery">
                                    <?php echo $item['ngaygh'] ?>
                                </div>
                                <div class="container-order-status">
                                    <?php echo $item['trangthaidh'] ?>
                                </div>
                                <div class="container-order-button">
                                    <?php if($item['trangthaidh'] != 'chua duyet' ){
                                        echo '<a href="xemvacapnhat.php?sodondh='.$item['sodondh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Xem đơn hàng"></a>';
                                        }
                                        else {
                                        echo '<a href="xemvacapnhat.php?sodondh='.$item['sodondh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Xác nhận đơn hàng"></a>
                                        ';
                                        }
                                    ?>
                                    <a href="admin.php?xoadonhang=<?php echo $item['sodondh']?>"><input type="button" name="xoadonhang" class="inputsubmit" value="Xóa"></a>
                                </div>
                            </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

    <!-- <script>
        // const addnew = document.getElementById("add");
        // const notifly = document.querySelector(".notifly-addnew");
        const tbthemloaihanghoa = document.querySelector(".notifly")
        // const dong = document.getElementById("dong");
        const close = document.getElementById("close");
        // addnew.addEventListener("click",function(e) {
        //     notifly.style.display = "flex";
        // });
        // dong.addEventListener("click",function(e) {
        //     notifly.style.display = "none";
        // });
        close.addEventListener("click",function(e) {
            tbthemloaihanghoa.style.display = "none";
        });
    </script> -->

</body>
</html>