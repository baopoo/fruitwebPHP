<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();


    if(isset($_GET['mskh'])){
        $mskh = $_GET['mskh'];
        $check = executeSingleResult('select * from dathang where mskh = '.$mskh.'');
        if($check == NULL){
            echo'<script>alert("Khách hàng có mã là '.$mskh.' chưa mua gì !")</script>';
        }
        else{
        $ketqua='select * from dathang d join chitietdathang c on d.sodondh = c.sodondh where mskh= '.$mskh.'';
        $kq=executeResult($ketqua);
            echo'
            <div class="notifly-lichsu" style="display:flex">
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
                    ';
                    foreach($kq as $item){
                        $history= 'SElect * FROM dathang d JOIN chitietdathang c on d.sodondh=c.sodondh JOIN hinhhanghoa h on c.mshh=h.mshh join hanghoa hh on c.mshh=hh.mshh where d.mskh=\''.$mskh.'\' and d.sodondh=\''.$item['sodondh'].'\' and h.mshh = '.$item['mshh'].' limit 1';
                        // echo $history;
                        $ht=executeResult($history);
                        foreach($ht as $key){
                            echo'
                            <div class="customer-product-item">
                                <div class="customer-product-code">
                                    <p>'.$key['sodondh'].'</p>
                                </div>
                                <div class="customer-product-info">
                                    <div class="customer-product-img" style="background-image: url(../anhsanpham/'.$key['tenhinh'].');"></div>
                                </div>
                                <div class="customer-product-name">
                                    <p>'.$key['tenhh'].'</p>
                                </div>
                                <p class="customer-product-soluong">'.$key['soluong'].'</p>
                                
                                <div class="customer-product-price">
                                    <p>'.$key['giadathang'].'<i>₫</i></p>
                                </div>
                                <div class="customer-product-giamgia">
                                    <p>'.$key['giamgia'].'<i>₫</i></p>
                                </div>
                                <div class="customer-product-status">
                                    <p>'.$key['trangthaidh'].'</p>
                                </div>
                            </div>
                            ';
                        }
                    }
                    echo'
                </div>
                <i class="ti-close donglichsu" id="donglichsu"></i>
            </div>
            <script>
                hienlichsu=document.querySelector(".notifly-lichsu");
                document.querySelector("#donglichsu").addEventListener("click", function(){
                hienlichsu.style.display="none";
                })
            </script>
            ';


        }
    }
    if(isset($_GET['xoamskh']) && $_GET['xoamskh']){
        $mskh = $_GET['xoamskh'];
        $getsddh= executeSingleResult('select * from dathang where mskh = '.$mskh.'');
        if($getsddh != NULL){
            execute('delete from dathang where sodondh = '.$getsddh['sodondh'].'');
            execute('delete from chitietdathang where sodondh = '.$getsddh['sodondh'].'');
        }
        // echo 'delete from khachhang where mskh = '.$mskh.'';
        execute('delete from diachikh where mskh = '.$mskh.'');
        execute('delete from khachhang where mskh = '.$mskh.'');
        unset($_SESSION['dn']);
        echo '
        <script>
            alert("Đã xóa khách hàng '.$mskh.'");
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
                        <a href="quanlykhachhang.php" class="active" style="color: var(--main-color); background-color:#fff;">
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
                        <p>Quản lý khách hàng</p>
                    </div>
                    <div class="container-loc">
                        <form action="" method="post" autocomplete="off">
                            <i>Lọc theo : </i>
                            <select id="label" placeholder="Tất cả" name="mucluc">
                                    <option value="Tất cả">Tất cả</option>
                                    <option value="mskh">Mã khách hàng</option>
                                    <option value="hotenkh">Tên khách hàng</option>
                                    <option value="tencongty">Tên công ty</option>
                                    <option value="sodienthoai">Số điện thoại</option>
                                    <option value="sofax">Số fax</option>
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
                        <!-- <a href=""><input type="submit" value="Thêm" class="inputsubmit"></a> -->
                    </div>
                </div>
                <div class="container-order">
                    <div class="container-order-title">
                        <div class="container-customer-code">
                            Mã khách hàng
                        </div>
                        <div class="container-customer-name">
                            Tên khách hàng
                        </div>
                        <div class="container-customer-namecty">
                            Tên công ty
                        </div>
                        <div class="container-customer-sdt">
                            Số điện thoại
                        </div>
                        <div class="container-customer-sofax">
                            Số fax
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
                            //     case 'Mã khách hàng':
                            //         $loctheo = 'mskh';
                            //         break;
                            //     case 'Tên khách hàng':
                            //         $loctheo = 'tenkh';
                            //         break;
                            //     case 'Tên công ty':
                            //         $loctheo = 'tencongty';
                            //         break;
                            //     case 'Số điện thoại':
                            //         $loctheo = 'sodienthoai';
                            //         break;
                            //     case 'Số fax':
                            //         $loctheo = 'sofax';
                            //         break;
                            //     case 'Email':
                            //         $loctheo = 'email';
                            //         break;
                                    
                            // }
                            // echo $giatri;
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from khachhang order by mskh ';
                            }
                            else{
                                $sql = 'select * from khachhang where '.$mucluc.' like  \'%'.$giatri.'%\' order by mskh ';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from khachhang order by mskh ';
                        }
                        // echo $sql;

                        $result = executeResult($sql);
                        foreach($result as $row) {
                            echo '
                            <div class="container-order-items">
                                <div class="container-customer-code">
                                    '.$row['mskh'].'
                                </div>
                                <div class="container-customer-name">
                                '.$row['hotenkh'].'
                                </div>
                                <div class="container-customer-namecty">
                                '.$row['tencongty'].'
                                </div>
                                <div class="container-customer-sdt">
                                '.$row['sodienthoai'].'
                                </div>
                                <div class="container-customer-sofax">
                                '.$row['sofax'].'
                                </div>
                                <div class="container-customer-email">
                                '.$row['email'].'
                                </div>
                                <div class="container-customer-button">
                                    <a href="quanlykhachhang.php?mskh='.$row['mskh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Lịch sử giao dịch"></a>
                                    <a href="quanlykhachhang.php?xoamskh='.$row['mskh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
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
    
    
</body>
</html>