<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();
    if(isset($_GET['xoamshh']) && $_GET['xoamshh']){
        $getth = executeResult('select * from hinhhanghoa where mshh='.$_GET['xoamshh'].'');
        foreach ($getth as $tenhinh){
            unlink('../anhsanpham/'.$tenhinh['tenhinh'].'');
        }
        $check = executeSingleResult('select * chitietdathang where mshh = '.$_GET['xoamshh'].'');
        if($check != NULL){
            execute('delete from chitietdathang where sodondh = '.$check['sodondh'].'');
            execute('delete from dathang where sodondh = '.$check['sodondh'].'');
        }
        execute('delete from hinhhanghoa where mshh = '.$_GET['xoamshh'].'');
        execute('delete from hanghoa where mshh = '.$_GET['xoamshh'].'');
        
        echo '
        <script>
            alert("Đã xóa hàng hóa '.$_GET['xoamshh'].'");
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
                        <a href="quanlyhanghoa.php" class="active" style="color: var(--main-color); background-color:#fff;">
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
                            <select id="label" placeholder="Tất cả" name="mucluc">
                                    <option value="Tất cả">Tất cả</option>
                                    <option value="mshh">Mã sản phẩm</option>
                                    <option value="tenhh">Tên sản phẩm</option>
                                    <option value="quycach">Quy cách</option>
                                    <option value="gia">Giá</option>
                                    <option value="tenloaihang">Tên loại hàng</option>
                                    <option value="hot">Nổi bật</option>
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
                        <a href="themhanghoa.php"><input type="submit" value="Thêm" class="inputsubmit"></a>
                    </div>
                </div>
                <div class="container-product">
                    <div class="container-order-title">
                        <div class="container-product-code">
                            Mã sản phẩm
                        </div>
                        <div class="container-product-imgs">
                            Sản phẩm
                        </div>
                        <div class="container-product-name">
                            Tên sản phẩm
                        </div>
                        <div class="container-product-quycach">
                            Quy cách
                        </div>
                        <div class="container-product-mota">
                            Mô tả
                        </div>
                        <div class="container-product-price">
                            Giá
                        </div>
                        <div class="container-product-soluong">
                            Số lượng
                        </div>
                        <div class="container-product-tenloai">
                            Tên loại hàng
                        </div>
                        <div class="container-product-hot">
                            Nổi bật
                        </div>
                        <div class="container-product-button">

                        </div>
                    </div>
                <?php
                        if(isset($_POST['loc']) && ($_POST['loc'])){
                            $mucluc = $_POST['mucluc'];
                            // echo $mucluc;
                            $giatri = $_POST['giatri'];
                            // switch ($mucluc){
                            //     case 'Mã sản phẩm':
                            //         $loctheo = 'mshh';
                            //         break;
                            //     case 'Tên sản phẩm':
                            //         $loctheo = 'tenhh';
                            //         break;
                            //     case 'Quy cách':
                            //         $loctheo = 'quycach';
                            //         break;
                            //     case 'Giá':
                            //         $loctheo = 'gia';
                            //         break;
                            //     case 'Tên loại hàng':
                            //         $loctheo = 'tenloaihang';
                            //         break;
                            //     case 'Nổi bật':
                            //         $loctheo = 'hot';
                            //         break;
                                    
                            // }
                            // echo $giatri;
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from hanghoa order by mshh ';
                            }
                            else if($mucluc == 'hot'){
                                $sql = 'select * from hanghoa where '.$mucluc.' = '.$giatri.' order by mshh ';
                            }
                            else if($mucluc == 'tenloaihang'){
                                $sql = 'select * from hanghoa h join loaihanghoa lh on h.maloaihang = lh.maloaihang where '.$mucluc.' like  \'%'.$giatri.'%\' order by mshh ';
                            }
                            else{
                                $sql = 'select * from hanghoa where '.$mucluc.' like  \'%'.$giatri.'%\' order by mshh ';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from hanghoa order by mshh ';
                        }
                        // echo $sql;



                        $result = executeResult($sql);
                        foreach ($result as $row){
                            $kq = executeSingleResult('select * from hanghoa h join loaihanghoa lh on h.maloaihang=lh.maloaihang join hinhhanghoa hh on hh.mshh = h.mshh where h.mshh = '.$row['mshh'].' limit 1');
                            echo '
                            <div class="container-product-items">
                                <div class="container-product-code">
                                    '.$row['mshh'].'
                                </div>
                                <div class="container-product-imgs">
                                    <div class="container-product-imgs-item" style="background-image: url(../anhsanpham/'.$kq['tenhinh'].');"></div>
                                </div>
                                <div class="container-product-name">
                                '.$kq['tenhh'].'
                                </div>
                                <div class="container-product-quycach">
                                '.$kq['quycach'].'
                                </div>
                                <div class="container-product-mota">
                                    <div class="product-desr">
                                        <p>'.$kq['mota'].'</p>
                                    </div>
                                </div>
                                <div class="container-product-price">
                                '.$kq['gia'].'
                                </div>
                                <div class="container-product-soluong">
                                '.$kq['soluonghang'].'
                                </div>
                                <div class="container-product-tenloai">
                                '.$kq['tenloaihang'].'
                                </div>
                                <div class="container-product-hot">
                                '.$kq['hot'].'
                                </div>
                                <div class="container-product-button">
                                    <a href="capnhathanghoa.php?mshh='.$row['mshh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Cập nhập"></a>
                                    <a href="quanlyhanghoa.php?xoamshh='.$row['mshh'].'"><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                                </div>
                            </div>
                            ';

                        }
                ?>
                    <!-- <div class="container-product-items">
                        <div class="container-product-code">
                            1
                        </div>
                        <div class="container-product-imgs">
                            <div class="container-product-imgs-item" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="container-product-name">
                            Chôm Chôm
                        </div>
                        <div class="container-product-quycach">
                            Kg
                        </div>
                        <div class="container-product-mota">
                            <div class="product-desr">
                                <p>Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo</p>
                            </div>
                        </div>
                        <div class="container-product-price">
                            50000
                        </div>
                        <div class="container-product-soluong">
                            50
                        </div>
                        <div class="container-product-tenloai">
                            Trái cây
                        </div>
                        <div class="container-product-hot">
                            1
                        </div>
                        <div class="container-product-button">
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Cập nhập"></a>
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                        </div>
                    </div> -->
                    <!-- <div class="container-product-items">
                        <div class="container-product-code">
                            1
                        </div>
                        <div class="container-product-imgs">
                            <div class="container-product-imgs-item" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="container-product-name">
                            Chôm Chôm Chôm Chôm Chôm Chôm Chôm Chôm 
                        </div>
                        <div class="container-product-quycach">
                            Kg
                        </div>
                        <div class="container-product-mota">
                            <div class="product-desr">
                                <p>Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo</p>
                            </div>
                        </div>
                        <div class="container-product-price">
                            50000
                        </div>
                        <div class="container-product-soluong">
                            50
                        </div>
                        <div class="container-product-tenloai">
                            Trái cây
                        </div>
                        <div class="container-product-hot">
                            1
                        </div>
                        <div class="container-product-button">
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Cập nhập"></a>
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                        </div>
                    </div>
                    <div class="container-product-items">
                        <div class="container-product-code">
                            1
                        </div>
                        <div class="container-product-imgs">
                            <div class="container-product-imgs-item" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="container-product-name">
                            Chôm Chôm
                        </div>
                        <div class="container-product-quycach">
                            Kg
                        </div>
                        <div class="container-product-mota">
                            <div class="product-desr">
                                <p>Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo Bảo</p>
                            </div>
                        </div>
                        <div class="container-product-price">
                            50000
                        </div>
                        <div class="container-product-soluong">
                            50
                        </div>
                        <div class="container-product-tenloai">
                            Trái cây
                        </div>
                        <div class="container-product-hot">
                            1
                        </div>
                        <div class="container-product-button">
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Cập nhập"></a>
                            <a href=""><input type="submit" name="capnhatdh" class="inputsubmit" value="Xóa"></a>
                        </div>
                    </div> -->
                </div>


            </div>
        </div>
    </div>

</body>
</html>