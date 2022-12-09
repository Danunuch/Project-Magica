<?php
include('menu_l.php');
require_once('../config/db.php');

if (isset($_REQUEST['update_id'])) {
    $id = $_REQUEST['update_id'];
    $select_stmt = $conn->prepare("SELECT * FROM dealer WHERE id = :id");
    $select_stmt->bindParam(':id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
}

if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $line_Id = $_POST['line_Id'];
    $address =  $_POST['address'];
    $Org_name =  $_POST['Org_name'];
    $license_type =  $_POST['license_type'];
    $Id_card =  $_POST['Id_card'];
    $license_number =  $_POST['license_number'];
    $urole = 'dealer';
    $level =  $_POST['level'];
    $d_img =  $_FILES['d_img'];
    $img_dealer = $row['d_img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $d_img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt = strtolower(end($extention)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "../admin/d_img/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($d_img['size'] > 0 && $d_img['error'] == 0) {
            if (move_uploaded_file($d_img['tmp_name'], $filePath)) {
                $insert_stmt = $conn->prepare("UPDATE dealer SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , password = :password , line_Id = :line_Id ,
                                                                        address = :address, d_img = :d_img , Org_name = :Org_name , license_type = :license_type , Id_card = :Id_card , level = :level , license_number = :license_number, urole = :urole WHERE id = :id");
                $insert_stmt->bindParam(':id', $id);
                $insert_stmt->bindParam(':firstname', $firstname);
                $insert_stmt->bindParam(':lastname', $lastname);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':tel', $tel);
                $insert_stmt->bindParam(':password', $passwordHash);
                $insert_stmt->bindParam(':line_Id', $line_Id);
                $insert_stmt->bindParam(':address', $address);
                $insert_stmt->bindParam(':d_img', $fileNew);
                $insert_stmt->bindParam(':urole', $urole);
                $insert_stmt->bindParam(':Org_name', $Org_name);
                $insert_stmt->bindParam(':license_type', $license_type);
                $insert_stmt->bindParam(':Id_card', $Id_card);
                $insert_stmt->bindParam(':license_number', $license_number);
                $insert_stmt->bindParam(':level', $level);
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขข้อมูลตัวแทนจำหน่ายเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=dealer.php'>";
                    //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                    // header("refresh:2;product.php");
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {

        $insert_stmt = $conn->prepare("UPDATE dealer SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , password = :password , line_Id = :line_Id ,
                address = :address, d_img = :d_img , Org_name = :Org_name , license_type = :license_type , Id_card = :Id_card , level = :level , license_number = :license_number, urole = :urole WHERE id = :id");
        $insert_stmt->bindParam(':id', $id);
        $insert_stmt->bindParam(':firstname', $firstname);
        $insert_stmt->bindParam(':lastname', $lastname);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->bindParam(':tel', $tel);
        $insert_stmt->bindParam(':password', $passwordHash);
        $insert_stmt->bindParam(':line_Id', $line_Id);
        $insert_stmt->bindParam(':address', $address);
        $insert_stmt->bindParam(':d_img', $img_dealer);
        $insert_stmt->bindParam(':urole', $urole);
        $insert_stmt->bindParam(':Org_name', $Org_name);
        $insert_stmt->bindParam(':license_type', $license_type);
        $insert_stmt->bindParam(':Id_card', $Id_card);
        $insert_stmt->bindParam(':license_number', $license_number);
        $insert_stmt->bindParam(':level', $level);
        $insert_stmt->execute();

        if ($insert_stmt) {
            echo "<script>alert('แก้ไขข้อมูลตัวแทนจำหน่ายเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=dealer.php'>";
            //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

            // header("refresh:2;product.php");
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        }
    }
}

?>

<style>
    .body {
        font-family: 'Kanit', sans-serif;
    }

    .home-content2 {
        font-size: 20px;
        color: #000;
        width: auto;
        font-weight: bold;
    }

    .title {
        font-size: 14px;

    }

    .h5 {
        font-size: small;
        font-weight: normal;

    }

    .card {
        width: 800px;
        height: auto;
    }

    .ex {
        display: flex;
        justify-content: flex-end;
    }

    .ta {
        font-size: 16px;
    }

    /* input file */
    .filewrap {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #ccc;
        border: 1px solid #ccc;
        border-radius: 7px 7px 7px 7px;
        background-image: url('../admin/images/file-upload.png');
        background-repeat: no-repeat;
        background-size: cover;
        height: 159px;
        width: 139px;
        color: #fff;
        font-family: sans-serif;
        font-size: 12px;
        z-index: 1;
        margin: 5px;
    }

    input[type="file"] {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;

    }

    .bi-plus-circle {
        position: absolute;
        width: 60px;
        height: 60px;
        color: blue;
        font-size: 60px;
        z-index: 2;
    }
</style>


<div class="container" style="max-width: 800px;">
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php  } ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php  } ?>
    <?php if (isset($_SESSION['warning'])) { ?>
        <div class="alert alert-warning" role="alert">
            <?php
            echo $_SESSION['warning'];
            unset($_SESSION['warning']);
            ?>
        </div>
    <?php  } ?>
</div>


<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>แก้ไขข้อมูลตัวแทนจำหน่าย (สถานประกอบการ)</h3>
                    </div> <br>
                    <?php
                    if (isset($errorMsg)) {
                    ?>
                        <div class="alert alert-danger">
                            <strong>Wrong! <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php } ?>


                    <?php
                    if (isset($updateMsg)) {
                    ?>
                        <div class="alert alert-success">
                            <strong>Success! <?php echo $updateMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <br>
                    <form id="dealer_edit_form" method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">

                        <?php
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $select_stmt = $conn->prepare("SELECT * FROM dealer WHERE id = :id");
                            $select_stmt->bindParam(":id", $id);
                            $select_stmt->execute();
                            $data_id_dealer = $select_stmt->fetchAll();
                        }
                        ?>
                        <div class="form-group text-center">
                            <div class="row gx-5">
                                <div class="col" style="display: inline-flex;" align="left">
                                    <div class="p-3"><label for="d_img" class="col-form-label" style="margin-bottom: 0px;">รูปภาพโปรไฟล์ <label class="col-form-label" style="color: red;">(กรุณาอัปโหลดรูปโปรไฟล์ทุกครั้ง)</label></label>
                                        <div class="filewrap">
                                            <input name="d_img" id="imgInput" value="" class="form-control" type="file" />
                                            <img width="100%" id="previewImg" src="../admin/d_img/<?php echo  $data_id_dealer[0]['d_img']; ?>" alt="">
                                        </div>
                                    </div>


                                </div>

                            </div>



                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <input type="hidden" name="id" value="<?php echo $data_id_dealer[0]['id']; ?>">
                                    <div class="p-3"><label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['firstname']; ?>" class="form-control" name="firstname" aria-describedby="firstname">
                                    </div>
                                </div>
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['lastname']; ?>" class="form-control" name="lastname" aria-describedby="lastname">
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                                        <input type="email" value="<?php echo $data_id_dealer[0]['email']; ?>" class="form-control" name="email" aria-describedby="email">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['line_Id']; ?>" class="form-control" name="line_Id" aria-describedby="line_Id">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                                        <input type="tel" value="<?php echo $data_id_dealer[0]['tel']; ?>" class="form-control" maxlength="10" name="tel" aria-describedby="tel">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['address']; ?>" class="form-control" name="address" id="address" aria-describedby="address">
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3"><label for="Org_name" class="form-label" style="margin-bottom: 0px;">ชื่อสถานประกอบการ</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['Org_name']; ?>" class="form-control" name="Org_name" id="Org_name">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3"> <label for="license_type" class="col-form-label">ประเภทใบอนุญาต</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['license_type']; ?>" class="form-control" name="license_type" id="license_type" aria-describedby="license_type">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="Id_card" class="col-form-label">รหัสประจำตัวใบประกอบวิชาชีพ</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['Id_card']; ?>" class="form-control" name="Id_card" id="Id_card" aria-describedby="Id_card">

                                    </div>
                                </div>


                                <div class="col" align="left">
                                    <div class="p-3"> <label for="license_number" class="col-form-label">ใบอนุญาตเลขที่ (ขย.5)</label>
                                        <input type="text" value="<?php echo $data_id_dealer[0]['license_number']; ?>" class="form-control" name="license_number" id="license_number" aria-describedby="license_number">

                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="level" class="col-form-label">สถานะ</label>
                                        <select class="form-control" value="<?php echo $data_id_dealer[0]['level']; ?>" name="level" id="">
                                            <option value="<?php echo $data_id_dealer[0]['level']; ?>">
                                                <?php echo $data_id_dealer[0]['level']; ?>
                                            </option>
                                            <option value="">เลือกข้อมูล</option>
                                            <option value="ร้านขายยา">ร้านขายยา</option>
                                            <option value="คลินิก">คลินิก</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3">
                                    <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="dealer.php" class="btn btn-danger">ยกเลิก</a>
                                </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>


        <script>
            let imgInput = document.getElementById('imgInput');
            let previewIm = document.getElementById('previewImg');


            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        </script>
    </div>

</body>