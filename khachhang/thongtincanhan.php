<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();
    if(!isset($_SESSION['dn'])){
        header('Location:dangnhap.php');
    }
    
    $sql='select * from khachhang where email=\''.$_SESSION['email'].'\'';
    $rs=executeSingleResult($sql);
    $mskh=$rs['mskh'];
    

    if(isset($_POST['update']) && $_POST['update']){
        $update = 'update khachhang set hotenkh=\''.$_POST['tenkh'].'\', tencongty=\''.$_POST['tencty'].'\', sodienthoai= \''.$_POST['sodienthoai'].'\',sofax=\''.$_POST['sofax'].'\' where mskh='.$mskh.'';
        // echo $update;
        execute($update);
        $diachi=$_POST['diachi'];
        $timdc = 'select * from diachikh where mskh = '.$mskh.' and diachi = \''.$diachi.'\'';
        $rsdc = executeSingleResult($timdc);
        if($rsdc == NULL){
            $setdc= 'insert into diachikh(diachi,mskh) values(\''.$diachi.'\','.$mskh.')';
            // echo $setdc;
            execute($setdc);
        }
        header("Refresh:0");
    }
    // echo $mskh;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>
<body>
<?php
        include("nav.php");
    ?>
    <div class="nav-introduce">
        <div class="nav-review slogan">
           <!----> <div class="icon"><img src="./img/buildings.png" alt=""></div>
            <div class="mota">
                <strong>BaoPoo Food</strong>
                <p>Thực phẩm sạch cho mỗi nhà</p>
            </div>
        </div>
        <div class="nav-review slogan1">
          <!---->  <div class="icon"><img src="./img/car.png" alt=""></div>
            <div class="mota">
                <strong>Miễn phí vận chuyển</strong>
                <p>Phạm vi trên toàn quốc</p>
            </div>
        </div>
        <div class="nav-review slogan2">
           <!----> <div class="icon"><img src="./img/letter.png" alt=""></div>
            <div class="mota">
                <strong>Hỗ trợ 24/7</strong>
                <p>Hotline: <strong>19112000</strong></p>
            </div>
        </div>
        <div class="nav-review slogan3">
            <div class="icon"><img src="./img/clock.png" alt=""></div>
            <div class="mota">
                <strong>Giờ làm việc</strong>
                <p>Các ngày trong tuần</p>
            </div>
        </div>
    </div>
    <div class="header">
        <ul class="header-nav">
            <li><a href="trangchu.php">Trang Chủ</a></li>
            <li><a href="sanpham.php">Sản Phẩm </a></li>
        </ul>

    </div>
    <div class="container">
        <div class="cart-introduce">
            <a href="trangchu.php">Trang chủ</a>
            <i>></i>
            <p style="color:#fe9705">Thông tin cá nhân</p>
        </div>
        <div class="container-customer">
            <div class="customer-info">
                <h1>Thông tin cá nhân</h1>
                <form action="" method="post" autocomplete="off">
                    <div class="form__group field">
                        <input type="input" class="form__field" style="width: 100%;" name="tenkh" placeholder="Tên khách hàng" value="<?php echo $rs['hotenkh'] ?>" required />
                        <label for="name" class="form__label">Họ và tên</label>
                    </div>
                    <div class="form__group field">
                        <input type="input" class="form__field" style="width: 100%;" name="tencty" placeholder="Tên công ty" value="<?php echo $rs['tencongty'] ?>" />
                        <label for="name" class="form__label">Tên Công Ty</label>
                    </div>
                    
                    <div class="form__group field">
                                    <input type="input" class="form__field" style="width: 100%;" name="sodienthoai" placeholder="Số điện thoại" value="<?php echo $rs['sodienthoai'] ?>" required />
                                    <label for="name" class="form__label">Số điện thoại</label>
                    </div>
                    <div class="form__group field">
                        <input type="input" class="form__field" style="width: 100%;" name="sofax" placeholder="Số fax" value="<?php echo $rs['sofax'] ?>"  />
                        <label for="name" class="form__label">Số fax</label>
                    </div>
                            
                    <div class="form__group field">
                        <input type="input" class="form__field" list="diachi" name="diachi" style="width: 100%;" placeholder="Địa chỉ khách hàng" name="diachi"  />
                        <label for="name" class="form__label">Địa chỉ giao hàng</label>
                        <datalist id="diachi">
                            <?php
                            $getdiachi=executeResult('select * from diachikh where mskh = '.$mskh.'');
                            foreach ($getdiachi as $key) {
                                echo'
                                <option value="'.$key['diachi'].'">
                                ';
                            }
                            
                            ?>
                        </datalist>
                    </div>
                    <div class="product-detail-btn">
                        <input type="submit" name="update" id="diachi" class="product-detail-btn btn-add btn-buy" value="Cập nhật">
                    </div>
                </form>
                
            </div>
            <div class="customer-history">
                <h1>Lịch sử đặt hàng</h1>
                <div class="customer-product">
                    <!-- <div class="customer-product-title">
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
                    </div> -->
                   
                    <?php
                        $check = executeSingleResult('select * from dathang where mskh = '.$mskh.'');
                        if($check == NULL){
                            echo'
                            <div class="chuadathang">
                                <p>Bạn chưa đặt hàng lần nào, hãy mua <a href="sanpham.php">sản phẩm</a> ủng hộ shop nhé !</p>
                            </div>
                            ';
                        }
                        else{
                        $ketqua='select * from dathang d join chitietdathang c on d.sodondh = c.sodondh where mskh= '.$mskh.'';
                        $kq=executeResult($ketqua);
                        echo'
                        <div class="customer-product-title">
                            <div class="customer-product-code">
                                <p>Mã đơn hàng</p>
                            </div>
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
                    }
                    ?>
                    <!-- <div class="customer-product-item">
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
                    </div> -->
                    <!-- <div class="customer-product-item">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>









    <div class="footer">
        <div class="footer-trangtri">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
        </div>
        <div class="footer-body">
            <div class="footer-contact">
                <span class="footer-name">Liên hệ</span>
                <p>Chúng tôi chuyên cung cấp các sản phẩm thực phẩm sạch an toàn cho sức khỏe con người</p>
                <p><i class="footer-icon ti-home"></i> Thời Đông, Cờ Đỏ, Thành phố Cần Thơ, Việt Nam</p>
                <p><i class="footer-icon ti-timer"></i> Thứ 2 - Chủ nhật: 7:30 - 17:00</p>
                <p><i class="footer-icon ti-user"></i> 0385832071</p>
                <p><i class="footer-icon ti-email"></i> baopoofood@gmail.com</p>
            </div>
            <div class="footer-support">
                <span class="footer-name">Hỗ trợ khách hàng</span>
                <ul class="footer-support-list">
                    <li><a href="trangchu.php">Trang chủ</a></li>
                    <li><a href="sanpham.php">Sản phẩm</a></li>
                </ul>

            </div>
            <div class="footer-link">
                <span class="ti-facebook"> <a href="">Kết nối với BaopooFood</a></span>
                
            </div>
        </div>

    </div>
</body>
</html>