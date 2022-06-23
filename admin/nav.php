<?php
    if(isset($_POST['dangxuat']) && $_POST['dangxuat']){
        unset($_SESSION['dnadmin']);
        // var_dump($_SESSION['dn']);
        header('Location:dangnhapad.php');
    }
    if(isset($_SESSION['dnadmin'])){
        $sql= 'select * from nhanvien where email =\''.$_SESSION['emailad'].'\'';
        $rs=executeSingleResult($sql);
        echo'
        <div class="nav">
            <div class="nav-logo">
                <img src="./img/foodavatar1.png" width="200px" height="60px" alt="">
            </div>
            <div class="nav-main">
                <div class="nav-title">
                    <p>Food Store Manager</p>
                </div>
                <div class="nav-info">
                    <div class="nav-item">
                        <img src="./img/admin1.png" width="40px" height="40px" alt="">
                        <p>'.$rs['chucvu'].'</p>
                        <i>'.$rs['hotennv'].'</i>
                    </div>
                    <div class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="inputsubmit" name="dangxuat" value="Đăng xuất">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
    else {
        header('Location:dangnhapad.php');
    }

?>
        
<!-- <div class="nav">
            <div class="nav-logo">
                <img src="./img/foodavatar1.png" width="200px" height="60px" alt="">
            </div>
            <div class="nav-main">
                <div class="nav-title">
                    <p>Food Store Manager</p>
                </div>
                <div class="nav-info">
                    <div class="nav-item">
                        <img src="./img/admin1.png" width="40px" height="40px" alt="">
                        <p>Nhân viên</p>
                        <i>Bảo</i>
                    </div>
                    <div class="nav-item">
                        <form action="" method="post">
                            <input type="submit" class="inputsubmit" name="dangxuat" value="Đăng xuất">
                        </form>
                    </div>
                </div>
            </div>
        </div> -->