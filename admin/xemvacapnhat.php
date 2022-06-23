<?php
    include('DBHelper.php');
    if(!isset($_GET['sodondh'])){
        header('location:admin.php');
    }
    if(isset($_GET['sodondh'])){
        $madh = $_GET['sodondh'];
        // echo $madh;
        $result = executeSingleResult('select * from dathang where sodondh = '.$madh.'');
        $rs = executeResult('select * from chitietdathang where sodondh = '.$madh.'');
        $staff = executeSingleResult('select * from nhanvien where msnv = '.$result['msnv'].'');
        $customer = executeSingleResult('select * from khachhang where mskh = '.$result['mskh'].'');
        // echo $thaotac;
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
            <a href="admin.php"><p>Quản lý đơn đặt hàng</p></a>
            <i>></i>
            <p style="color: var(--main-color);"><?php echo $madh ?></p>
        </div>
        <div class="the-order">
            <div class="order-info-genaral">
                <div class="order-info-input">
                    <h2>Thông tin đơn</h2>
                    <form action="admin.php" autocomplete="off" method="post">
                        <div class="form__group field">
                            <input type="input" class="form__field" name="madonhang" placeholder="Mã đơn hàng" value="<?php echo $madh ?>" readonly />
                            <label for="name" class="form__label">Mã đơn hàng</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field"  placeholder="Ngày đặt hàng" value="<?php echo $result['ngaydh'] ?>" readonly />
                            <label for="name" class="form__label">Ngày đặt hàng</label>
                        </div>
                        <?php 
                            if($result['trangthaidh'] == 'chua duyet'){
                                echo '
                                <div class="form__group field">
                                    <input type="input" class="form__field" list="trangthai" placeholder="Trạng thái đơn hàng" value="'.$result['trangthaidh'].'"  readonly />
                                    <label for="name" class="form__label">Trạng thái đơn hàng</label>
                                </div>
                                ';
                            }
                            else {
                                echo '
                                <div class="form__group field">
                                    <input type="input" class="form__field" placeholder="Ngày giao hàng" value="'.$result['ngaygh'].'" readonly />
                                    <label for="name" class="form__label">Ngày giao hàng</label>
                                </div>
                                <div class="form__group field">
                                    <input type="input" class="form__field" placeholder="Tên nhân viên duyệt đơn" value="'.$staff['hotennv'].'" readonly />
                                    <label for="name" class="form__label">Tên nhân viên duyệt đơn</label>
                                </div>
                                <div class="form__group field">
                                    <input type="input" class="form__field"  placeholder="Trạng thái đơn hàng" value="'.$result['trangthaidh'].'"  required />
                                    <label for="name" class="form__label">Trạng thái đơn hàng</label>
                                </div>
                                ';
                            }
                        ?>
                        <div class="viewanhupdate">
                            <input type="submit" name="duyet" id="hiddenduyet" hidden class="product-detail-btn btn-add" value="Cập nhật">
                        </div>
                        <!-- <div class="form__group field">
                            <input type="input" class="form__field" placeholder="Ngày giao hàng" value="" readonly />
                            <label for="name" class="form__label">Ngày giao hàng</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field" placeholder="Tên nhân viên duyệt đơn" value="" readonly />
                            <label for="name" class="form__label">Tên nhân viên duyệt đơn</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field" list="trangthai"  placeholder="Trạng thái đơn hàng" name="diachi"  required />
                            <label for="name" class="form__label">Trạng thái đơn hàng</label>
                            <datalist id="trangthai">
                                <option value="Da duyet"></option>
                            </datalist>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="order-info-customer">
                <div class="order-info-input">
                    <h2>Thông tin khách hàng</h2>
                    <form action="" autocomplete="off">
                    <div class="form__group field">
                            <input type="input" class="form__field"  placeholder="Mã khách hàng" value="<?php echo $result['mskh'] ?>" readonly />
                            <label for="name" class="form__label">Mã khách hàng</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field"  placeholder="Tên khách hàng" value="<?php echo $customer['hotenkh'] ?>" readonly />
                            <label for="name" class="form__label">Tên khách hàng</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field"  placeholder="Số điện thoại" value="<?php echo $customer['sodienthoai'] ?>" readonly />
                            <label for="name" class="form__label">Số điện thoại</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field" placeholder="Tên công ty" value="<?php echo $customer['tencongty'] ?>" readonly />
                            <label for="name" class="form__label">Tên Công ty</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field" placeholder="Số fax" value="<?php echo $customer['sofax'] ?>" readonly />
                            <label for="name" class="form__label">Số fax</label>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="order-detail">
            <div class="customer-product">
                <div class="customer-product-title">
                    <div class="customer-product-code">
                        <p>Mã hàng hóa</p>
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
                </div>
                <?php
                $thanhtien = 0;
                $giamgia = 0;
                foreach ($rs as $item) {
                    $gethh = executeSingleResult('select * from hanghoa h join hinhhanghoa hh on h.mshh = hh.mshh where h.mshh = '.$item['mshh'].' limit 1');
                    $thanhtien += $item['giadathang'];
                    $giamgia += $item['giamgia'];
                    echo '
                    <div class="customer-product-item">
                        <div class="customer-product-code">
                            <p>'.$gethh['mshh'].'</p>
                        </div>
                        <div class="customer-product-info">
                            <div class="customer-product-img" style="background-image: url(../anhsanpham/'.$gethh['tenhinh'].');"></div>
                        </div>
                        <div class="customer-product-name">
                            <p>'.$gethh['tenhh'].'</p>
                        </div>
                        <p class="customer-product-soluong">'.$item['soluong'].'</p>
                        
                        <div class="customer-product-price">
                            <p>'.number_format($item['giadathang']).'<i>₫</i></p>
                        </div>
                        <div class="customer-product-giamgia">
                            <p>'.number_format($item['giamgia']).'<i>₫</i></p>
                        </div>
                    </div>
                    ';
                }
                ?>
                <!-- <div class="customer-product-item">
                    <div class="customer-product-code">
                        <p>1</p>
                    </div>
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
                <!-- <div class="customer-product-item">
                    <div class="customer-product-code">
                        <p>1</p>
                    </div>
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
                    <div class="customer-product-code">
                        <p>1</p>
                    </div>
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
            <div class="customer-product-intomoney">
                <div class="order-product-tinhtien">
                    <div class="order-product-tamtinh">
                        <div class="order-product-title">
                            Tạm tính
                        </div>
                        <div class="order-product-sotien">
                            <p><?php echo number_format($thanhtien) ?><i>₫</i></p>
                        </div>
                    </div>
                    <div class="order-product-tamtinh">
                        <div class="order-product-title">
                            Phí vận chuyển
                        </div>
                        <div class="order-product-sotien">
                            <p><i>Miễn phí</i></p>
                        </div>
                    </div>
                    <div class="order-product-tamtinh">
                        <div class="order-product-title">
                            Giảm giá
                        </div>
                        <div class="order-product-sotien">
                            <p><?php echo number_format($giamgia) ?><i>₫</i></p>
                        </div>
                    </div>
                </div>
                <div class="order-product-total">
                    <div class="order-product-total-title">
                        Tổng cộng
                    </div>
                    <div class="order-product-total-price">
                        <p><?php echo number_format($thanhtien - $giamgia) ?><i>₫</i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-detail-button">
                <?php
                if($result['trangthaidh'] == 'chua duyet'){
                    echo '<input type="submit" id="duyet" name="duyet" form="capnhatdh" class="product-detail-btn btn-add" value="Xác nhận">';
                }
                ?>
            <a href="admin.php"><input type="submit" class="product-detail-btn btn-buy" value="Trở lại"></a>
        </div>
    </div>

    <div class="notifly">
        <div class="custom-alert check-order">
            <i class="ti-check"></i>
            <p>Đã xác nhận đơn hàng</p>
            <!-- <a href="admin.php">Về trang chủ</a> -->
            <!-- <button id="close">Đóng</button> -->
        </div>
    </div>

    <!-- <script>
        var dong= document.querySelector("#close");
        var thongbao = document.querySelector(".notifly");
        dong.addEventListener("click",function(){
            thongbao.style.display = "none";
        })
    </script> -->
    <script>
        var hiddenduyet = document.getElementById("hiddenduyet");
        var duyet = document.getElementById("duyet");
        var thongbao = document.querySelector(".notifly");
        console.log(duyet);
        console.log(hiddenduyet);
        duyet.addEventListener("click",function(){
            // alert("ngu");
            thongbao.style.display = "flex";
            setTimeout(() => {
                hiddenduyet.click();
            }, 1500);
        })

    </script>
</body>
</html>