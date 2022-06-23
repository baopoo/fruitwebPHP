<?php
    session_start();
?>
<?php
    require_once('DBHelper.php');
    $id='';
    if(isset($_GET['maloaihang'])){
        $id = $_GET['maloaihang'];
        // $sql = 'select * from maloaihang where maloaihang='.$id;
        // $danhmuc = executeSingleResult($sql);
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
            <li style="background-color: #fe9705;"><a href="sanpham.php">Sản Phẩm </a></li>
        </ul>
        <div class="header-search">
                <input type="text" class="header-input" name="keyword" id="keyword" placeholder="Tìm sản phẩm">
                <a href="" class="header-icon-search ti-search" id="timkiem"></a>
                <script>
                    const keyword = document.getElementById("keyword");
                    keyword.addEventListener("change", function() {
                        // console.log(keyword.value);
                        document.getElementById("timkiem").href = "sanpham.php?timkiem="+keyword.value;
                    });
                    
                </script>
        </div>

    </div>
    <div class="container">
        <div class="grid">
                <div class="cart-introduce">
                    <a href="trangchu.php">Trang chủ</a>
                    <i>></i>
                    <a href="sanpham.php">Sản phẩm</a>
                </div>
            <div class="grid_row">
                <div class="grid_column-2">
                    <div class="category">
                        <h3 class="category-heading">
                            Loại Sản Phẩm
                        </h3>

                        <ul class="category-list">

                        <?php
                            $sql= 'select * from loaihanghoa';
                            $result = executeResult($sql);
                            foreach($result as $item){
                                echo'
                                <li class="category-item">
                                    <a href="sanpham.php?maloaihang='.$item['maloaihang'].'" class="catelogy-item-link">'.$item['tenloaihang'].'</a>
                                </li>
                                ';
                            }
                        ?>

                            


                            <!-- <li class="category-item">
                                <a href="" class="catelogy-item-link">Rau củ</a>
                            </li>
                            <li class="category-item">
                                <a href="" class="catelogy-item-link">Thịt</a>
                            </li>
                            <li class="category-item">
                                <a href="" class="catelogy-item-link">Hải sản</a>
                            </li> -->
                        </ul>
                    </div>
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
                        </div> -->
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
                <div class="grid_column-10">
                    <!-- <form action="" method="post">
                    <div class="home-filter">
                        <span class="home-filter-sapxep">Sắp xếp:</span>
                        <button class="btn">Phổ biến</button>
                        <button class="btn">Mới nhất</button>
                        <button class="btn">Bán chạy</button>
                        <div class="select-input">
                            <span class="select-input-label">Tất cả</span>
                            <i class="select-input-icon ti-angle-down"></i>
                            <ul class="select-input-list">
                                <li><input type="text" class="select-input-item" value="Giá: Tăng dần"></li>
                                <li><input type="text" class="select-input-item" value="Giá: Giảm dần"></li>
                                <li><input type="text" class="select-input-item" value="Chữ cái: A-Z"></li>
                                <li><input type="text" class="select-input-item" value="Chữ cái: Z-A"></li>
                            </ul>
                        </div>
                        <select name="mucluc" id="">
                            <option value="Tất cả">Tất cả</option>
                            <option value="Tất cả">Giá: Tăng dần</option>
                            <option value="Tất cả">Giá: Giảm dần</option>
                            <option value="Tất cả">Chữ: A-Z</option>
                            <option value="Tất cả">Chữ: Z-A</option>
                        </select>
                        <input type="submit" value="Lọc" class="inputsubmit">
                    </div>
                    </form> -->
                    <div class="home-product">
                        <div class="grid_row">
                        <?php
                            $sql = '';
                            if(isset($_GET['timkiem']) && $_GET['timkiem'] !=''){
                                $sql = 'select mshh from hanghoa where tenhh like \'%'. $_GET['timkiem'] .'%\'';
                            }
                            else {
                                $sql = 'select mshh from hanghoa';
                            }
                            // echo $sql;
                                $result = executeResult($sql);
                                $sqli='';
                                foreach ($result as $row) {
                                    if(!empty($id)){
                                        $sqli = 'select * from hinhhanghoa hh join hanghoa h on h.mshh = hh.mshh where hh.mshh = ' .$row['mshh']. ' 
                                        and h.maloaihang ='.$id.' limit 1';
                                    }
                                    else {
                                        $sqli = 'select * from hinhhanghoa hh join hanghoa h on h.mshh = hh.mshh where hh.mshh = ' .$row['mshh']. ' 
                                         limit 1';
                                    }
    
                                    
                                    $masohh='';
                                    $hanghoa = executeResult($sqli);

                                    foreach ($hanghoa as $item) {
                                        $masohh=$item['mshh'];
                                        $ctsp='chitietsanpham.php?mshh='.$masohh.'';
                                        //  echo $ctsp;
                                        echo 
                                            '
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
                            </div> -->
                        </div>
                    </div>
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





    <!-- <script>
        const clickvaosanpham = document.querySelectorAll('.grid_column-2-product');
        const masohh="<?php $masohh ?>";
        console.log(masohh);
        clickvaosanpham.forEach(function(sanpham){
            sanpham.addEventListener('click',function(){
                window.location.href = 'chitietsanpham.php?mahanghoa=';
            })
        })

        // function col4HandleClick(event) {

        //     let col4;
        //     let inputElement;

        //     if(event.target.className == 'col-4') {
        //         col4 = event.target;
        //         inputElement = event.target.children[4];
        //     } else if(event.target.parentNode.className == 'rating') {
        //         col4 = event.target.parentNode.parentNode;
        //         inputElement = col4.children[4];
        //     } else {
        //         col4 = event.target.parentNode;
        //         inputElement = col4.children[4];
        //     }

        //     document.location.href = http://localhost/baocao/product-detail.php?mshh=${inputElement.value};
        // }
    </script> -->
</body>
</html>