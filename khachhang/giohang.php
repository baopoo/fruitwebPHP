<?php
    session_start();
?>
<?php
    $tb='';
    require_once('DBHelper.php');
    // if(!isset($_SESSION['giohang'])){
    //     $_SESSION['giohang']=[];
    // }
    if(!isset($_SESSION['dn'])){
        header('location:dangnhap.php');
    }
    if(isset($_GET['xoacart']) && $_GET['xoacart'] == 'true'){
        unset($_SESSION['giohang']);
    }
    if(isset($_GET['xoasanpham']) && $_GET['xoasanpham'] >= 0){
        array_splice($_SESSION['giohang'],$_GET['xoasanpham'],1);
    }
    if(isset($_GET['thanhtoan']) && $_GET['thanhtoan'] == 1){
       //echo'ngu';
        if(isset($_SESSION['dn'])){
            header('location:dathang.php');
        }
        else{
            // $tb='Bạn phải <a href="dangnhap.php">đăng nhập</a> để mua hàng !';
            echo'
            <div class="notifly" style="display:flex;">
                <div class="custom-alert alert-cart">
                    <i class="ti-info"></i>
                    <p>Bạn cần phải đăng nhập để đặt hàng</p>
                    <a href="dangnhap.php">Đăng nhập</a>
                    <button id="close">Đóng</button>
                </div>
            </div>
            <script>
                var dong= document.querySelector("#close");
                var thongbao = document.querySelector(".notifly");
                dong.addEventListener("click",function(){
                    thongbao.style.display = "none";
                })

            </script>
            ';
        }
    }
    
    //lấy dữ liệu từ form
    // if (isset($_POST['addcart']) && ($_POST['addcart'])) {
    //     $masp=$_POST['masp'];
    //     $anhsp=$_POST['anhsp'];
    //     $tensp=$_POST['tensp'];
    //     $giasp=$_POST['giasp'];
    //     $soluongsp=$_POST['soluongsp'];
    //     $co=0;
    //     for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
    //         if($_SESSION['giohang'][$i][0] == $masp){
    //             $co = 1;
    //             $soluongmoi=$soluongsp + $_SESSION['giohang'][$i][4];
    //             $_SESSION['giohang'][$i][4]=$soluongmoi;
    //             break;
    //         }
    //     }

    //     if($co == 0){
    //         $sanpham=[$masp,$anhsp,$tensp,$giasp,$soluongsp];
    //         $_SESSION['giohang'][] = $sanpham;
    //     }
    //    // var_dump($_SESSION['giohang']);
    // }

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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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
            <a href="">Trang chủ</a>
            <i>></i>
            <p>Giỏ hàng của bạn</p>
        </div>
        <?php
        if(!isset($_SESSION['giohang']) || empty($_SESSION['giohang'])){
            echo'<div class="cart-alert" style="display:block;">Bạn chưa thêm sản phẩm nào vào giỏ hàng! Hãy mua <a href="sanpham.php">sản phẩm</a> ủng hộ shop nhé !</div>
            ';
        }
        ?>
        <form action="" class="form-cart" style="display:block;">
            <!-- <div class="cart-body-top">
                <div class="cart-heading">
                    <div class="cart-info">
                        <p>Sản Phẩm</p>
                    </div>
                    <div class="cart-name">
                        <p>Tên Sản Phẩm</p>
                    </div>
                    <div class="cart-price">
                        <p>Đơn Giá</p>
                    </div>
                    <div class="cart-soluong">
                        <p>Số lượng</p>
                    </div>
                    <div class="cart-money">
                        <p>Thành tiền</p>
                    </div>
                    <div class="cart-delete">
                        <p>Xóa</p>
                    </div>
                </div>
                <div class="cart-product"> -->
                    <?php
                        
                        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang'])) && !empty($_SESSION['giohang'])){
                            echo'
                            <div class="cart-body-top">
                                <div class="cart-heading">
                                    <div class="cart-info">
                                        <p>Sản Phẩm</p>
                                    </div>
                                    <div class="cart-name">
                                        <p>Tên Sản Phẩm</p>
                                    </div>
                                    <div class="cart-price">
                                        <p>Đơn Giá</p>
                                    </div>
                                    <div class="cart-soluong">
                                        <p>Số lượng</p>
                                    </div>
                                    <div class="cart-money">
                                        <p>Thành tiền</p>
                                    </div>
                                    <div class="cart-delete">
                                        <p>Xóa</p>
                                    </div>
                                </div>
                                <div class="cart-product">
                            ';
                            $thanhtien=0;
                            for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                                $tt = $_SESSION['giohang'][$i][3] * $_SESSION['giohang'][$i][4];
                                $thanhtien += $tt;
                                echo'
                                <div class="cart-product-item">
                                    <div class="cart-info" >
                                        <div class="cart-imgs" style="background-image: url(../anhsanpham/'.$_SESSION['giohang'][$i][1].');"></div>
                                    </div>
                                    <div class="cart-name" style="color: #61B000;">
                                        <p>'.$_SESSION['giohang'][$i][2].'</p>
                                    </div>
                                    <div class="cart-price">
                                        <p>'.number_format($_SESSION['giohang'][$i][3]).'<i>₫</i></p>
                                    </div>
                                    <div class="cart-soluong">
                                        <p>'.$_SESSION['giohang'][$i][4].'</p>
                                        <input type="hidden" min="1" class="producct-detail-number" id="product-detail-number" value="'.$_SESSION['giohang'][$i][4].'">
                                    </div>
                                    <div class="cart-money">
                                        <span class="cart-money-number">'.number_format($tt).'<i>₫</i></span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="giohang.php?xoasanpham='.$i.'" class="cart-delete-icon ti-trash"></a>
                                    </div>
                                </div>
                                ';
                            }

                            echo'
                            </div>
                        </div>
                            <div class="cart-body-bottom">
                                <div class="cart-total">
                                    <p>Tổng tiền:</p>
                                    <span class="cart-total-money">'.number_format($thanhtien).'<i>₫</i></span>
                                </div>
                                <div class="cart-button">
                                    <button type="button" class="product-detail-btn btn-ctn" onclick=change()>
                                        Tiếp tục mua hàng
                                    </button>
                                    <a href="giohang.php?xoacart=true"> <button type="button" class="product-detail-btn btn-del">Xóa giỏ hàng</button> </a>
                                    <a href="giohang.php?thanhtoan=1"> <button type="button" class="product-detail-btn btn-cpl">Tiến hành đặt hàng</button> </a>                                       
                                    
                                </div>
                                <div style="clear: both"></div>
                            </div>
                            ';
                        }
        

                    ?>
                    
                    <!-- <div class="cart-product-item">
                        <div class="cart-info" >
                            <div class="cart-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="cart-name" style="color: #61B000;">
                            <p>Chôm Chôm</p>
                        </div>
                        <div class="cart-price">
                            <p>65000<i>₫</i></p>
                        </div>
                        <div class="cart-soluong">
                            <p>1</p>
                            <input type="number" min="1" class="producct-detail-number" id="product-detail-number" value="1">
                        </div>
                        <div class="cart-money">
                            <span class="cart-money-number">65000<i>₫</i></span>
                        </div>
                        <div class="cart-delete">
                            <i class="cart-delete-icon ti-trash"></i>
                        </div>
                    </div> -->
                    <!-- <div class="cart-product-item">
                        <div class="cart-info" >
                            <div class="cart-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="cart-name" style="color: #61B000;">
                            <p>Chôm Chôm</p>
                        </div>
                        <div class="cart-price">
                            <p id="cart-price-product">65000<i>đ</i></p>
                        </div>
                        <div class="cart-soluong">
                            <input type="number" min="1" class="producct-detail-number" value="1">
                        </div>
                        <div class="cart-money">
                            <span class="cart-money-number">65000<i>₫</i></span>
                        </div>
                        <div class="cart-delete">
                            <i class="cart-delete-icon ti-trash"></i>
                        </div>
                    </div>
                    <div class="cart-product-item">
                        <div class="cart-info" >
                            <div class="cart-imgs" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                        </div>
                        <div class="cart-name" style="color: #61B000;">
                            <p>Chôm Chôm</p>
                        </div>
                        <div class="cart-price">
                            <p>65000<i>₫</i></p>
                        </div>
                        <div class="cart-soluong">
                            <input type="number" min="1" class="producct-detail-number" value="1">
                        </div>
                        <div class="cart-money">
                            <span class="cart-money-number">65000<i>₫</i></span>
                        </div>
                        <div class="cart-delete">
                            <i class="cart-delete-icon ti-trash"></i>
                        </div>
                    </div> -->
                <!-- </div>
            </div> -->
            
            <!-- <div class="cart-body-bottom">
                <div class="cart-total">
                    <p>Tổng tiền:</p>
                    <span class="cart-total-money">200000<i>₫</i></span>
                </div>
                <div class="cart-button">
                    <button type="button" class="product-detail-btn btn-ctn" onclick=change()>
                        Tiếp tục mua hàng
                    </button>
                    <a href="giohang.php?xoacart=true"> <button type="button" class="product-detail-btn">Xóa giỏ hàng</button> </a>
                    <button type="submit" class="product-detail-btn btn-cpl">
                        Tiến hành đặt hàng
                    </button>
                    
                </div>
                <div style="clear: both"></div>
            </div> -->
        </form>
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

    <script>
        function change(){
            window.location.href='sanpham.php';
        }
    </script>
    
</body>
</html>