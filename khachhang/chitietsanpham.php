<?php
    session_start();
?>
<?php
    require_once('DBHelper.php');
    require_once('config.php');
    $id='';
    if(isset($_GET['mshh'])){
        $id = $_GET['mshh'];
       // echo $id;
        // $sql = 'select * from maloaihang where maloaihang='.$id;
        // $danhmuc = executeSingleResult($sql);
    }
    
    if(!isset($_SESSION['giohang'])){
        $_SESSION['giohang']=[];
    }
    if (isset($_POST['addcart']) && ($_POST['addcart'])) {
        if(isset($_SESSION['dn'])){
            $masp=$_POST['masp'];
            $anhsp=$_POST['anhsp'];
            $tensp=$_POST['tensp'];
            $giasp=$_POST['giasp'];
            $soluongsp=$_POST['soluongsp'];
            $soluongsptk = $_POST['soluongsptk'];
            echo $soluongsp;
            echo $soluongsptk;
            $co=0;
            $alert = '';
            if($soluongsp <= $soluongsptk){
                for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                    if($_SESSION['giohang'][$i][0] == $masp){
                        $co = 1;
                        $soluongmoi=$soluongsp + $_SESSION['giohang'][$i][4];
                        $_SESSION['giohang'][$i][4]=$soluongmoi;
                        break;
                    }
                }
        
                if($co == 0){
                    $sanpham=[$masp,$anhsp,$tensp,$giasp,$soluongsp];
                    $_SESSION['giohang'][] = $sanpham;
                }
                echo '
                <div class="notifly" style="display:flex">
                    <div class="custom-alert">
                        <i class="ti-check"></i>
                        <p>Đã thêm vào giỏ hàng</p>
                        <button id="close">Đóng</button>
                    </div>
                </div>
                <script>
                    var themgiohang = document.querySelector("#add-cart");
                    var dong= document.querySelector("#close");
                    var thongbao = document.querySelector(".notifly");
                    setTimeout(() => {
                            thongbao.style.display = "none";
                            // document.getElementById("hidden-add-cart").click();
                        }, 2000);
                    
                    dong.addEventListener("click",function(){
                        thongbao.style.display = "none";
                    })
                </script>
                ';
            }
            else {
                $alert = 'Số lượng sản phẩm trong kho không đủ vui lòng chọn lại !';
                // echo'
                // <div class="notifly" style="display:flex">
                //     <div class="custom-alert">
                //         <i class="ti-info"></i>
                //         <p>Số lượng trong kho không đủ !</p>
                //         <button id="close">Đóng</button>
                //     </div>
                // </div>
                // ';
            }
        
        }
        else{
            // $tb='Bạn phải <a href="dangnhap.php">đăng nhập</a> để mua hàng !';
            echo'
            <div class="notifly" style="display:flex;">
                <div class="custom-alert alert-cart">
                    <i class="ti-info"></i>
                    <p>Bạn cần phải đăng nhập để tạo giỏ hàng</p>
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
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.11.0.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
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
        <div class="header-search">
            <input type="text" class="header-input" placeholder="Tìm sản phẩm">
            <a href="" class="header-icon-search ti-search"></a>

        </div>

    </div>




    
    <div class="container">
        <div class="grid">
        <div class="cart-introduce">
            <?php $sql = 'select * from hanghoa where mshh = '.$id.'';
                $kq = executeSingleResult($sql);
                echo' 
                    <a href="trangchu.php">Trang chủ</a>
                    <i>></i>
                    <a href="sanpham.php">Sản phẩm</a>
                    <i>></i>
                    <p>'.$kq['tenhh'].'</p>
                    ';
            ?>        
                </div>
            <div class="grid_row">
                <div class="grid_column-10">
                    <form action="" method="post">
                    <div class="product-detail">

                        <div class="product-detail-imgs">
                            <?php
                                    $sql='select * from hinhhanghoa where mshh='.$id.'';
                                    $result = mysqli_query($con,$sql);
                                    $i = 0;
                                    
                                    do{
                                        $row = mysqli_fetch_array($result);
                                        $i = 1;
                                        echo '<div class="product-detail-imgs-large" id="imgs" style="background-image: url(../anhsanpham/'.$row[1].');"> 
                                            </div>
                                            <input type="hidden" name="anhsp" value="'.$row[1].'">
                                            ';                                   
                                    } while($i > 1);
                                    
                                      
                                    ?>
                            
                            <div class="product-detail-imgs-list">
                                    
                                <?php
                                    $sql='select * from hinhhanghoa where mshh='.$id.'';
                                    $result = mysqli_query($con,$sql);

                                    while($row = mysqli_fetch_array($result)){
                                    ?>
                                        <div onmouseover="change1(event)" class="product-detail-imgs-item" style="background-image: url(../anhsanpham/<?php echo $row['tenhinh']?>);"></div>
                                        <!-- <div onmouseover="change1(event)" class="product-detail-imgs-item" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                                        <div onmouseover="change1(event)" class="product-detail-imgs-item" style="background-image: url(http://bizweb.dktcdn.net/thumb/grande/100/361/770/products/98353473-676877796433716-1981155627803607040-n.jpg?v=1589959879393);"></div>
                                        <div onmouseover="change1(event)" class="product-detail-imgs-item" style="background-image: url(http://bizweb.dktcdn.net/thumb/grande/100/361/770/products/98353473-676877796433716-1981155627803607040-n.jpg?v=1589959879393);"></div> -->

                                    <?php  
                                    }
                                    ?>
                  

                            </div>
                        </div>

                        <?php
                                $sql='select * from hanghoa where mshh='.$id.'';
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result)){
                                ?>



                        <div class="product-detail-info">
                            <input type="hidden" name="masp" value="<?php echo $row['mshh'] ?>">
                            <span class="product-detail-tittle"><?php echo $row['tenhh'] ?></span>
                            <input type="hidden" name="tensp" value="<?php echo $row['tenhh'] ?>">
                            <div class="product-detail-price">
                                <span class="product-detail-price-current"><?php echo number_format($row['gia']) ?><i>đ</i></span>
                                <input type="hidden" name="giasp" value="<?php echo $row['gia'] ?>">
                                <!-- <div class="product-detail-price-olds">
                                    <p>Giá gốc:</p>
                                    <span class="product-detail-price-old">130000<i>đ</i></span>
                                    <span class="product-detail-price-sales">(-8%)</span>
                                </div> -->
                            </div>
                            <div class="product-detail-desr-sort">
                                <p><?php echo $row['mota'] ?></p>
                            </div>
                            <div class="product-detail-form">
                                <label for="">Số lượng:</label>
                                <input type="number" hidden name="soluongsptk" class="producct-detail-number" value="<?php echo $row['soluonghang'] ?>">
                                <input type="number" name="soluongsp" min="1" class="producct-detail-number" value="1">
                                <i>(<?php echo $row['quycach'] ?>)</i>
                            </div>
                            <i style="font-weight: 500; font-size: 14px;">Số lượng còn trong kho: <?php echo $row['soluonghang'] ?> </i>
                            <br>
                            <i style="color: red; font-size: 14px; font-weight:500"><?=isset($alert)?$alert:""?></i>
                            <div class="product-detail-button">
                                <!-- <button type="submit" class="product-detail-btn btn-add">Thêm vào giỏ hàng</button> -->
                                <input type="submit" name="addcart" id="add-cart" class="product-detail-btn btn-add" value="Thêm vào giỏ hàng">
                                <input type="submit" name="addcart" id="hidden-add-cart" hidden class="product-detail-btn btn-add" value="Thêm vào giỏ hàng">
                                <!-- <button type="submit" class="product-detail-btn btn-buy">Thanh toán</button> -->
                            </div>
                            <div class="product-detail-share">
                                <label for="">Chia sẻ:</label>
                                <i class="product-detail-share-icon ti-facebook"></i>
                                <i class="product-detail-share-icon ti-twitter-alt"></i>
                                <i class="product-detail-share-icon ti-instagram"></i>
                                <i class="product-detail-share-icon ti-google"></i>
                            </div>
                        </div>      
                    </div>
                    </form>
                    
                    <div class="product-detail-desr-main">
                            <p class="product-detail-desr-heading">Thông tin sản phẩm</p>
                            <p class="product-detail-desr">
                            <?php echo $row['mota'] ?>
                            </p>
                    </div>

                    <?php
                                }
                    ?>

                </div>

              


                <div class="grid_column-2">
                    <div class="category">
                        <h3 class="category-heading">
                            Sản Phẩm Nổi Bật
                        </h3>
                        <?php
                        $sql = 'select mshh from hanghoa where hot = 1 limit 3';
                        $result = executeResult($sql);
                        $sqli='';
                        foreach ($result as $row) {
                            $sqli = 'select * from hinhhanghoa hh join hanghoa h on h.mshh = hh.mshh where hh.mshh = ' .$row['mshh']. ' 
                            limit 1';
                            
                            $masohh='';
                            $hanghoa = executeResult($sqli);

                            foreach ($hanghoa as $item) {
                                $masohh=$item['mshh'];
                                $ctsp='chitietsanpham.php?mshh='.$masohh.'';
                                echo '
                                <div class="product-featured" onclick="window.location.href = \''.$ctsp.'\' ">
                                    <div class="home-product-img" style="background-image: url(../anhsanpham/'.$item['tenhinh'].');">
                                    </div>
                                    <div class="home-product-name">
                                        <a href="chitietsanpham.php?mshh='.$item['mshh'].'">'.$item['tenhh'].'</a>
                                    </div>
                                    <div class="home-product-price">
                                        <!--<span class="home-product-price-old">'.$item['gia'].'</span>-->
                                        <span class="home-product-price-current">'.number_format($item['gia']).'<i class="donvitiente">đ/'.$item['quycach'].'</i></span>
                                    </div>
        
                                </div>
                                
                                
                                ';
                            }
                        }
                        ?>




                        <!-- <div class="product-featured">
                            <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                            </div>
                            <div class="product-featured-info">
                                <div class="home-product-name">
                                    <a href="">Nhãn</a>
                                </div>
                                <div class="home-product-price">
                                    <span class="home-product-price-old">120000</span>
                                    <span class="home-product-price-current">100000</span>
                                </div>
    
                            </div>
                        </div>
                        <div class="product-featured">
                            <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                            </div>
                            <div class="product-featured-info">
                                <div class="home-product-name">
                                    <a href="">Nhãn</a>
                                </div>
                                <div class="home-product-price">
                                    <span class="home-product-price-old">120000</span>
                                    <span class="home-product-price-current">100000</span>
                                </div>
                                
                            </div>
                        </div>
                        <div class="product-featured">
                            <div class="home-product-img" style="background-image: url(./img/dualeo.jpg);">
                            </div>
                            <div class="product-featured-info">
                                <div class="home-product-name">
                                    <a href="">Nhãn</a>
                                </div>
                                <div class="home-product-price">
                                    <span class="home-product-price-old">120000</span>
                                    <span class="home-product-price-current">100000</span>
                                </div>
                                
                            </div>
                        </div> -->
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="soft-desr">
            <div class="soft-desr-name">
                <p>Sản phẩm liên quan</p>
            </div>
            <div class="soft-desr-gachduoi"></div>
        </div>

        
        <div class="home-product">
            <div class="home-product-slider">
                <?php
                    $kq = 'select * from hanghoa where mshh = '.$id.'';
                    $kqtam = executeSingleResult($kq);
                    $mlh = $kqtam['maloaihang'];
                    $sql = 'select mshh from hanghoa where maloaihang = '.$mlh.' and mshh <> '.$id.'';
                    $result = executeResult($sql);
                    $sqli='';
                    foreach ($result as $row) {
                        $sqli = 'select * from hinhhanghoa hh join hanghoa h on h.mshh = hh.mshh where hh.mshh = ' .$row['mshh']. ' 
                        limit 1';
                        
                        $masohh='';
                        $hanghoa = executeResult($sqli);

                        foreach ($hanghoa as $item) {
                            $masohh=$item['mshh'];
                            $ctsp='chitietsanpham.php?mshh='.$masohh.'';
                            echo '
                            <div class="grid_column-2-product">
                                <div class="home-product-item" onclick="window.location.href = \''.$ctsp.'\' ">
                                    <div class="home-product-img" style="background-image: url(../anhsanpham/'.$item['tenhinh'].');">
                                    </div>
                                    <div class="home-product-name">
                                        <a href="chitietsanpham.php?mshh='.$item['mshh'].'">'.$item['tenhh'].'</a>
                                    </div>
                                    <div class="home-product-price">
                                        <!--<span class="home-product-price-old">'.$item['gia'].'</span>-->
                                        <span class="home-product-price-current">'.number_format($item['gia']).'<i class="donvitiente">đ/'.$item['quycach'].'</i></span>
                                    </div>
                                                    
                                </div>
                            </div>
                            ';
                        }
                    }
                ?>
            </div>
        </div>






        <!-- <div class="home-product">
            <div class="home-product-slider">
                <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            <span class="home-product-price-old">120000</span>
                            <span class="home-product-price-current">100000</span>
                        </div>
                        <div class="home-product-sale">
                            <span class="home-product-sale-label">Giảm</span>
                            <span class="home-product-sale-percent">8%</span>
                        </div>
                    </div>
                </div>
                <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            <span class="home-product-price-old">120000</span>
                            <span class="home-product-price-current">100000</span>
                        </div>
                        <div class="home-product-sale">
                            <span class="home-product-sale-label">Giảm</span>
                            <span class="home-product-sale-percent">8%</span>
                        </div>
                    </div>
                </div>
                <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            <span class="home-product-price-old">120000</span>
                            <span class="home-product-price-current">100000</span>
                        </div>
                        <div class="home-product-sale">
                            <span class="home-product-sale-label">Giảm</span>
                            <span class="home-product-sale-percent">8%</span>
                        </div>
                    </div>
                </div>
                <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            <span class="home-product-price-old">120000</span>
                            <span class="home-product-price-current">100000</span>
                        </div>
                        <div class="home-product-sale">
                            <span class="home-product-sale-label">Giảm</span>
                            <span class="home-product-sale-percent">8%</span>
                        </div>
                    </div>
                </div>
                <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            <span class="home-product-price-old">120000</span>
                            <span class="home-product-price-current">100000</span>
                        </div>
                        <div class="home-product-sale">
                            <span class="home-product-sale-label">Giảm</span>
                            <span class="home-product-sale-percent">8%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
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

    <!-- <div class="notifly">
        <div class="custom-alert">
            <i class="ti-check"></i>
            <p>Đã thêm vào giỏ hàng</p>
            <button id="close">Đóng</button>
        </div>
    </div> -->




    <script >
        function change1(event){
           /* var url = document.getElementById("imgs1").style.backgroundImage;*/
            var url = event.target.style.backgroundImage;
           /* alert(url.substring(5, url.length-2));*/
            document.getElementById("imgs").style.backgroundImage = "url("+url.substring(4, url.length-1)+")";
        }
    </script>
    <!-- <script>
        var themgiohang = document.querySelector("#add-cart");
        var dong= document.querySelector("#close");
        var thongbao = document.querySelector(".notifly");
        setTimeout(() => {
                thongbao.style.display = "none";
                // document.getElementById("hidden-add-cart").click();
            }, 2500);
        
        dong.addEventListener("click",function(){
            thongbao.style.display = "none";
            document.getElementById("hidden-add-cart").click();
        })
    </script> -->
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.11.0.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script>
        $('.home-product-slider').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        prevArrow: '<button class="slide-arrow prev-arrow"><i class="prev ti-angle-double-left"></i></button>',
        nextArrow: '<button class="slide-arrow next-arrow"><i class="next ti-angle-double-right"></i></button>'
        });
    </script>
</body>
</html>