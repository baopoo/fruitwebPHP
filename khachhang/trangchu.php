<?php
    include('DBHelper.php');
    session_start();
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
    ></>
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
            <li class="header-nav-item"><a href="trangchu.php">Trang Chủ</a></li>
            <li><a href="sanpham.php">Sản Phẩm </a></li>
        </ul>

    </div>





    <div class="content">
        <div class="content-sliders">
            <a href="sanpham.php"><img id="content-imgs" src="./img/slider1.jpg" onclick="changeimgs()"></a>
        </div>
        <div class="soft-desr">
            <div class="soft-desr-name">
                <p>Đánh giá an toàn</p>
            </div>
            <div class="soft-desr-gachduoi"></div>
        </div>
        <div class="content-introduce">
            <div class="content-introduce-imgs1">
                <img  src="./img/giothieu1.jpg" alt="">
            </div>
            <div class="content-introduce-imgs2">
                <img  src="./img/gioithieu2.jpg" alt="">
            </div>
            <div class="content-introduce-imgs3">
                <img  src="./img/gioithieu3.jpg" alt="">
            </div>
        </div>
        <div class="soft-desr">
            <div class="soft-desr-name">
                <p>Sản phẩm nổi bật</p>
            </div>
            <div class="soft-desr-gachduoi"></div>
        </div>
       <!-- <div class="content-sanpham">
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/chanhday.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Chanh dây</p>
                </div>
                <div class="content-sanpham-price">
                    <p>400.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/dualeo.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Dưa leo</p>
                </div>
                <div class="content-sanpham-price">
                    <p>65.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/hanhtay.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Hành tây</p>
                </div>
                <div class="content-sanpham-price">
                    <p>45.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/taodo.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Táo đỏ</p>
                </div>
                <div class="content-sanpham-price">
                    <p>600.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/taonuhoang.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Táo nữ hoàng</p>
                </div>
                <div class="content-sanpham-price">
                    <p>500.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/chomchom.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Chôm</p>
                </div>
                <div class="content-sanpham-price">
                    <p>500.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/thanhlong.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Thanh long</p>
                </div>
                <div class="content-sanpham-price">
                    <p>100.000đ</p>
                </div>
            </div>
            <div class="content-sanpham-body">
                <div class="content-sanpham-imgs">
                    <img class="sanpham-img" src="./img/nhan.jpg" alt="">
                </div>
                <div class="content-sanpham-name">
                    <p>Nhãn</p>
                </div>
                <div class="content-sanpham-price">
                    <p>85.000đ</p>
                </div>
            </div>
        </div>-->
        <div class="home-product">
            <div class="home-product-slider">
                <?php
                    $sql = 'select mshh from hanghoa where hot = 1';
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
                <!-- <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
                        </div>
                        
                    </div>
                </div> -->
                <!-- <div class="grid_column-2-product">
                    <div class="home-product-item">
                        <div class="home-product-img" style="background-image: url(https://lh3.googleusercontent.com/bcXx46BlhbpwCZMXfov_tW_BDIn6Cjml0Ue8IIfIz7JOiQ6AcimS_vMSRXayv4TVerCE3I5Hi1vLIYM6H9mVCxXt-ZOM=w600);">
                        </div>
                        <div class="home-product-name">
                            <a href="">Nhãn</a>
                        </div>
                        <div class="home-product-price">
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
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
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
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
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
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
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
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
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
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
                            
                            <span class="home-product-price-current">100000<i class="donvitiente">đ</i></span>
                        </div>
                        
                    </div>
                </div> -->
                
                
            </div>
        </div>
        <div class="soft-desr">
            <div class="soft-desr-name">
                <p>Chính sách</p>
            </div>
            <div class="soft-desr-gachduoi"></div>
        </div>
        <div class="content-chinhsach">
            <div class="content-chinhsach-img">
                <img class="chinhsach-img" src="./img/chinhsach1.png" alt="">
            </div>
            <div class="content-chinhsach-img">
                <img class="chinhsach-img" src="./img/chinhsach2.png" alt="">
            </div>
        </div>
        <div class="soft-desr">
            <div class="soft-desr-name">
                <p>Tin tức, mẹo vặt cuộc sống </p>
            </div>
            <div class="soft-desr-gachduoi"></div>
        </div>
        <div class="content-news">
            <div class="content-news-body">
                <div class="content-news-imgs">
                    <img class="news-imgs" src="./img/tincapnhat1.jpg" alt="">
                </div>
                <div class="content-news-info">
                    <div class="content-news-tittle">
                        <a href="">Tự chế món thạch sữa chua thanh long linh lung màu sắc</a>
                    </div>
                    <div class="content-news-desr">
                        <p>Thạch sữa chua thanh long là món ăn tráng miệng tuyệt vời cho các mẹ. Đặc biệt là các bạn trẻ. Bởi vì món ăn này rất thanh mát, dễ ăn, đẹp da và trông rất màu sắc...</p>
                    </div>
                    <div class="content-news-chitiet"><a href="">Mẹo hay</a></div>
                </div>
                
            </div>
            <div class="content-news-body">
                <div class="content-news-imgs">
                    <img class="news-imgs" src="./img/tincapnhat2.jpg" alt="">
                </div>
                <div class="content-news-info">
                    <div class="content-news-tittle">
                        <a href="">Tự chế món thạch sữa chua thanh long linh lung màu sắc</a>
                    </div>
                    <div class="content-news-desr">
                        <p>Thạch sữa chua thanh long là món ăn tráng miệng tuyệt vời cho các mẹ. Đặc biệt là các bạn trẻ. Bởi vì món ăn này rất thanh mát, dễ ăn, đẹp da và trông rất màu sắc...</p>
                    </div>
                    <div class="content-news-chitiet"><a href="">Mẹo hay</a></div>
                </div>
                
            </div>
            <div class="content-news-body">
                <div class="content-news-imgs">
                    <img class="news-imgs" src="./img/tincapnhat3.jpg" alt="">
                </div>
                <div class="content-news-info">
                    <div class="content-news-tittle">
                        <a href="">Tự chế món thạch sữa chua thanh long linh lung màu sắc</a>
                    </div>
                    <div class="content-news-desr">
                        <p>Thạch sữa chua thanh long là món ăn tráng miệng tuyệt vời cho các mẹ. Đặc biệt là các bạn trẻ. Bởi vì món ăn này rất thanh mát, dễ ăn, đẹp da và trông rất màu sắc...</p>
                    </div>
                    <div class="content-news-chitiet"><a href="">Mẹo hay</a></div>
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
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="sanpham.php">Sản phẩm</a></li>
                </ul>

            </div>
            <div class="footer-link">
                <span class="ti-facebook"> <a href="">Kết nối với BaopooFood</a></span>
                
            </div>
        </div>

    </div>

    <script>
        var index=1;
        changeimgs = function(){
            var imgs=["./img/slider1.jpg","./img/slider2.jpg","./img/slider3.jpg"];
            document.getElementById('content-imgs').src = imgs[index];
            index++;
            if (index==3) {
                index=0;
            }
        }
        setInterval(changeimgs,2000);

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