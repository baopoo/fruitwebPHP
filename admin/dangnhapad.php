<?php
    require_once('DBHelper.php');
    require_once('config.php');
    session_start();

    if(isset($_POST['dangnhap']) && ($_POST['dangnhap'])){
        $email=$_POST['email'];
        $matkhau=$_POST['matkhau'];
        $alert1='';
     var_dump($email);
        $sql='select * from nhanvien where matkhau=\''.$matkhau.'\' and email=\''.$email.'\'';
        //var_dump($sql);
        $rs=executeSingleResult($sql);
        //var_dump($result);
        if($rs == NULL){
            $alert1="Email hoặc mật khẩu của bạn đã sai !";

        }
        else{
            $_SESSION['chucvu'] = $rs['chucvu'];
            $_SESSION['dnadmin']=true;
            $_SESSION['emailad']=$email;
            $_SESSION['matkhauad']=$matkhau;
            //var_dump($email);
            header('location:admin.php');
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
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <div class="container-login">
        <div class="login-content">
            <div class="login-logo">
                <div class="login-img"></div>
            </div>
            <h1 style="color: var(--main-color); font-size: 40px">BAOPOO</h1>
            <div class="login-form">
                <form action="" method="post">
                <div class="form__group field">
                    <input type="input" class="form__field" name="email" placeholder="Email" value=""/>
                    <label for="name" class="form__label label-login">Email</label>
                </div>
                <div class="form__group field">
                    <input type="password" class="form__field" name="matkhau" placeholder="Mật khẩu" value=""/>
                    <label for="name" class="form__label label-login">Mật khẩu</label>
                </div>
                <div class="login-button">
                    <input type="submit" value="Đăng nhập" name="dangnhap" class="inputsubmit submit-login">
                </div>
                </form>
            </div>
            <i style="color: red; margin-top: 10px"><?=isset($alert1)?$alert1:""?></i>
        </div>
    </div>
</body>
</html>