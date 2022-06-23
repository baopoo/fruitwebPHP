<?php
    require_once('DBHelper.php');
    require_once('config.php');

    if(isset($_POST['dangxuat']) && $_POST['dangxuat']){
        unset($_SESSION['dn']);
        // var_dump($_SESSION['dn']);
        unset($_SESSION['giohang']);
        header('Location:dangnhap.php');
    }


    if(isset($_SESSION['dn'])){
        $sql= 'select * from khachhang where email =\''.$_SESSION['email'].'\'';
        $result=executeSingleResult($sql);
        echo'
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <i class="ti-mobile"></i>
                    <strong>Hotline: </strong>0385832071
                </li>
                <li class="nav-item">
                    <i class="ti-hand-point-right"></i>
                    <strong>Địa chỉ: </strong>Huyện Cờ Đỏ, Thành Phố Cần Thơ
                </li>
            </ul>
            <ul class="nav-list">
                <li class="nav-item"><a style="display:flex;justify-content: space-between;" href="thongtincanhan.php?email='.$_SESSION['email'].'">
                                        
                                        <p>Chào</p> 
                                        <p style="margin-left: 10px;"><i class="ti-user"></i> '.$result['hotenkh'].' </p>
                                    </a>
                </li>
                <li class="nav-item"><a href="giohang.php">
                                        <i class="ti-shopping-cart"></i>
                                        <strong>Giỏ Hàng</strong>
                                    </a>
                </li>
                <li class="nav-item"><form action="" method="post"><input type="submit" name="dangxuat" value="Đăng xuất"></form></li>
            </ul>
        </div>
        ';
    } else {
        echo'
        <div class="nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <i class="ti-mobile"></i>
                    <strong>Hotline: </strong>0385832071
                </li>
                <li class="nav-item">
                    <i class="ti-hand-point-right"></i>
                    <strong>Địa chỉ: </strong>Huyện Cờ Đỏ, Thành Phố Cần Thơ
                </li>
            </ul>
            <ul class="nav-list">
                <li class="nav-item"><a href="dangnhap.php">
                                        <i class="ti-user"></i>
                                        Đăng nhập
                                    </a>
                                    </li>
                <li class="nav-item"><a href="giohang.php">
                                        <i class="ti-shopping-cart"></i>
                                        <strong>Giỏ Hàng</strong>
                                    </a>
                </li>
            </ul>
        </div>
        ';
    }
    


        
   





?>








