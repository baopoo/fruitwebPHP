<?php
    include('DBHelper.php');
    session_start();
    if(isset($_GET['maloaihang'])){
        $rs = executeSingleResult('select * from loaihanghoa where maloaihang =\''.$_GET['maloaihang'].'\'');
        echo'
        <div class="notifly-addnew" style="display:flex;">
            <div class="notifly-content">
                <h3>Thêm loại hàng hóa</h3>
                <form action="quanlylhh.php" method="post" autocomplete="off">
                    <div class="form__group field field-notifly">
                        <input type="input" hidden class="form__field" name="mlh" value="'.$rs['maloaihang'].'" placeholder="Tên loại hàng" value="" />
                        <input type="input" class="form__field" name="tlh" value="'.$rs['tenloaihang'].'" placeholder="Tên loại hàng" value="" />
                        <label for="name" class="form__label">Tên loại hàng</label>
                    </div>
                    <div class="notifly-button">
                        <input type="submit" class="inputsubmit" name="cnmlh" id="add-new" value="Cập nhật">
                        <button class="inputsubmit" id="dong">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
        ';
    }
    if(isset($_POST['cnmlh']) && $_POST['cnmlh']){
        $mlh =  $_POST['mlh'];
        $tlh = $_POST['tlh'];
        // echo $mlh;
        $kiemtra = 'select * from loaihanghoa where tenloaihang =\''.$tlh.'\'';
        // echo $kiemtra;
        $check = executeSingleResult($kiemtra);
        // $mlh = $check['maloaihang'];
        if(trim($tlh) != ''){
            // echo $maloaihang;
            if($check == NULL) {
                $sql = 'update loaihanghoa set tenloaihang =\''.$tlh.'\' where maloaihang = '.$mlh.'';
                echo '
                <div class="notifly" style="display:flex;">
                    <div class="custom-alert check-order">
                        <i class="ti-check"></i>
                        <p>Cập nhật thành công</p>
                        <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
                    </div>
                </div>
                <script>
                setTimeout(() => {
                    tbthemloaihanghoa.style.display = "none";
                    }, 2000);
            </script>
                ';
                execute($sql);
            }
            else {
                echo '
                <div class="notifly" style="display:flex;">
                    <div class="custom-alert check-order">
                        <i class="ti-info"></i>
                        <p>Loại hàng đã tồn tại</p>
                        <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
                    </div>
                </div>
                ';
            }
            echo'
            <script>
                const tbthemloaihanghoa = document.querySelector(".notifly")
                const close = document.getElementById("close");
                close.addEventListener("click",function(e) {
                    tbthemloaihanghoa.style.display = "none";
                });
                setTimeout(() => {
                    tbthemloaihanghoa.style.display = "none";
                    }, 2000);
            </script>
            ';
        }
    }





    if(isset($_GET['xoamlh'])){
        $tlh = $_GET['xoamlh'];
        $sql = 'delete from loaihanghoa where maloaihang ='.$tlh.'';
        // echo 'select * from hanghoa h JOIN chitietdathang ct on h.mshh = ct.mshh WHERE h.maloaihang = '.$tlh.'';
        $getmshh = executeSingleResult('select * from hanghoa h JOIN chitietdathang ct on h.mshh = ct.mshh WHERE h.maloaihang = '.$tlh.'');
        if($getmshh != NULL){
            $getth = executeResult('select * from hinhhanghoa where mshh='.$getmshh['mshh'].'');
            foreach ($getth as $tenhinh){
                unlink('../anhsanpham/'.$tenhinh['tenhinh'].'');
            }
            execute('delete from hinhhanghoa where mshh='.$getmshh['mshh'].'');
            execute('delete from dathang where sodondh ='.$getmshh['sodondh'].'');
        }
        execute('delete from hanghoa where maloaihang = '.$tlh.'');
        
        
        execute($sql);
        echo '
            <script>
                alert("Đã xóa loại hàng hóa '.$tlh.'");
            </script>
            ';
    }
    // if(isset($_POST['themlhh']) && $_POST['themlhh']){
    //     $sql = 'insert into loaihanghoa(tenloaihang) values (\''.$_POST['tenloaihang'].'\')';
    //     echo $sql;
    //     // execute();
    // }
    // if(isset($_GET['tenloaihang'])){
    //     $tlh = $_GET['tenloaihang'];
    //     $check = executeSingleResult('select * from loaihanghoa where tenloaihang =\''.$tlh.'\'');
    //     // echo $check;
    //     if($tlh != ''){
    //         $gmmaloaihang = executeSingleResult('select max(maloaihang) from loaihanghoa');
    //         if($gmmaloaihang['max(maloaihang)'] == NULL){
    //             $maloaihang = 1;
    //         }
    //         else{
    //             $maloaihang = $gmmaloaihang['max(maloaihang)'] + 1;
    //         }
    //         // echo $maloaihang;
    //         if($check == NULL) {
    //             $sql = 'insert into loaihanghoa(maloaihang,tenloaihang) values ('.$maloaihang.',\''.$tlh.'\')';
    //             echo '
    //             <div class="notifly" style="display:flex;">
    //                 <div class="custom-alert check-order">
    //                     <i class="ti-check"></i>
    //                     <p>Thêm thành công</p>
    //                     <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
    //                 </div>
    //             </div>
    //             ';
    //             execute($sql);
    //         }
    //         else {
    //             echo '
    //             <div class="notifly" style="display:flex;">
    //                 <div class="custom-alert check-order">
    //                     <i class="ti-info"></i>
    //                     <p>Loại hàng đã tồn tại</p>
    //                     <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
    //                 </div>
    //             </div>
    //             ';
    //         }
    //     }
    // }
    if(isset($_POST['themlhh']) && $_POST['themlhh']){
        $tlh =  $_POST['tenloaihang'];
        // echo $tlh;
        $check = executeSingleResult('select * from loaihanghoa where tenloaihang =\''.$tlh.'\'');
        if(trim($tlh) != ''){
            $gmmaloaihang = executeSingleResult('select max(maloaihang) from loaihanghoa');
            if($gmmaloaihang['max(maloaihang)'] == NULL){
                $maloaihang = 1;
            }
            else{
                $maloaihang = $gmmaloaihang['max(maloaihang)'] + 1;
            }
            // echo $maloaihang;
            if($check == NULL) {
                $sql = 'insert into loaihanghoa(maloaihang,tenloaihang) values ('.$maloaihang.',\''.$tlh.'\')';
                echo '
                <div class="notifly" style="display:flex;">
                    <div class="custom-alert check-order">
                        <i class="ti-check"></i>
                        <p>Thêm thành công</p>
                        <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
                    </div>
                </div>
                <script>
                    const tbthemloaihanghoa = document.querySelector(".notifly")
                        const close = document.getElementById("close");
                        close.addEventListener("click",function(e) {
                            tbthemloaihanghoa.style.display = "none";
                        });
                        setTimeout(() => {
                            tbthemloaihanghoa.style.display = "none";
                            }, 2000);
                    </script>
                ';
                execute($sql);
            }
            else {
                echo '
                <div class="notifly" style="display:flex;">
                    <div class="custom-alert check-order">
                        <i class="ti-info"></i>
                        <p>Loại hàng đã tồn tại</p>
                        <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
                    </div>
                </div>
                <script>
                    const tbthemloaihanghoa = document.querySelector(".notifly")
                        const close = document.getElementById("close");
                        close.addEventListener("click",function(e) {
                            tbthemloaihanghoa.style.display = "none";
                        });
                        setTimeout(() => {
                            tbthemloaihanghoa.style.display = "none";
                            }, 2000);
                    </script>
                ';
            }
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
                        <a href="quanlylhh.php" class="active" style="color: var(--main-color); background-color:#fff;">
                            <i class="ti-agenda"></i>
                            <p>Quản lý loại hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlyhanghoa.php" class="active">
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
                        <p>Quản lý loại hàng hóa</p>
                    </div>
                    <div class="container-loc">
                        <form action="" autocomplete="off" method="post">
                            <i>Lọc theo : </i>
                            <select id="label" placeholder="Tất cả" name="mucluc">
                                    <option value="Tất cả">Tất cả</option>
                                    <option value="maloaihang">Mã loại hàng</option>
                                    <option value="tenloaihang">Tên loại hàng</option>
                            </select>
                            <input type="input" list="giatri" placeholder="Giá trị" name="giatri">
                            <input type="submit" placeholder="Tất cả" class="inputsubmit" name="loc" value="Lọc">
                        </form>
                    </div>
                    <div class="container-addnew">
                        <input type="submit" value="Thêm" id="add" class="inputsubmit">
                    </div>
                </div>
                <div class="container-catalogy">
                    <div class="container-catalogy-title">
                        <div class="container-catalogy-code">
                            Mã loại hàng
                        </div>
                        <div class="container-catalogy-name">
                            Tên loại hàng
                        </div>
                        <div class="container-catalogy-button">
                            <!-- <a href=""><input type="submit" class="inputsubmit" value="xóa"></a> -->
                        </div>
                    </div>
                    <?php
                        if(isset($_POST['loc']) && ($_POST['loc'])){
                            $mucluc = $_POST['mucluc'];
                            // echo $mucluc;
                            $giatri = $_POST['giatri'];
                            // echo $giatri;
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from loaihanghoa order by maloaihang ';
                            }
                            else{
                                $sql = 'select * from loaihanghoa where '.$mucluc.' like  \'%'.$giatri.'%\' order by maloaihang ';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from loaihanghoa order by maloaihang ';
                        }
                        // echo $sql;
                        $ketqua = executeResult($sql);
                        foreach($ketqua as $item) {

                    ?>
                    <div class="container-catalogy-items">
                        <div class="container-catalogy-code">
                        <?php echo $item['maloaihang'] ?>
                        </div>
                        <div class="container-catalogy-name">
                        <?php echo $item['tenloaihang'] ?>
                        </div>
                        <div class="container-catalogy-button">
                            <a href="quanlylhh.php?maloaihang=<?php echo $item['maloaihang'] ?>"><input type="submit" name="capnhatlhh" class="inputsubmit" value="Sửa"></a>
                            <a href="quanlylhh.php?xoamlh=<?php echo $item['maloaihang'] ?>"><input type="submit" class="inputsubmit" value="xóa"></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- <div class="container-catalogy-items">
                        <div class="container-catalogy-code">
                            2
                        </div>
                        <div class="container-catalogy-name">
                            Rau củ
                        </div>
                        <div class="container-catalogy-button">
                            <a href=""><input type="submit" class="inputsubmit" value="xóa"></a>
                        </div>
                    </div> -->
                </div>


            </div>
        </div>
    </div>
    <?php
        // if(isset($_GET['']))
    ?>
    <div class="notifly-addnew">
        <div class="notifly-content">
            <h3>Thêm loại hàng hóa</h3>
            <form action="quanlylhh.php" method="post" autocomplete="off">
                <div class="form__group field field-notifly">
                    <input type="input" class="form__field" name="tenloaihang" placeholder="Tên loại hàng" value="" />
                    <label for="name" class="form__label">Tên loại hàng</label>
                </div>
                <div class="notifly-button">
                    <input type="submit" class="inputsubmit" name="themlhh" id="add-new" value="Thêm">
                    <input type="button" value="Đóng" class="inputsubmit" id="dongthemhh" name="dongthemhh">
                </div>
            </form>
        </div>
    </div>
    

    <script>
        const addnew = document.getElementById("add");
        const notifly = document.querySelector(".notifly-addnew");
        // const tbthemloaihanghoa = document.querySelector(".notifly")
        // setTimeout(() => {
        //     notifly.style.display = "none";
        //         // document.getElementById("hidden-add-cart").click();
        //     }, 2000);
        addnew.addEventListener("click",function(e) {
            notifly.style.display = "flex";
        });
        document.getElementById("dongthemhh").addEventListener("click",function(e) {
            notifly.style.display = "none";
        })
    </script>

    <script>
        // const codemaloai = document.getElementsByClassName("container-catalogy-code");
        // const tenmaloai = document.getElementsByClassName("container-catalogy-name");
        // // console.log(codemaloai.innerHTML);
        // // console.log(tenmaloai.innerHTML);
        // for(var i = 0 ; i < codemaloai.length ; i++) {
        //     console.log(codemaloai[i]);
        // }
        // function capnhatlh(mlh){
        //     console.log(document.getElementById(`maloaihang${mlh}`))
        //     document.getElementById(`maloaihang${mlh}`).style.display = "flex"
        //     const dong = document.getElementById(`dongcn${mlh}`)
        //     dong.addEventListener("click", function(e){
        //         // console.log("ngu")
        //         document.getElementById(`maloaihang${mlh}`).style.display = "none"
        //     })
        // }
    </script>
</body>
</html>