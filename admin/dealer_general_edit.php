<?php
include('menu_l.php');
require_once('../config/db.php');


if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM dealer_general WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

if (isset($_POST['btn_update'])) {

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $line_Id = $_POST['line_Id'];
    $address =  $_POST['address'];
    $Id_card =  $_POST['Id_card'];
    $urole = 'dealer_general';
    $level =  $_POST['level'];
    $m_img =  $_FILES['m_img'];
    $img_dealer_gen = $row['m_img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $m_img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt = strtolower(end($extention)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "../admin/dg_img/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($m_img['size'] > 0 && $m_img['error'] == 0) {
            if (move_uploaded_file($m_img['tmp_name'], $filePath)) {
                $insert_stmt = $conn->prepare("UPDATE dealer_general SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , line_Id = :line_Id ,
                                                                        address = :address, m_img = :m_img , Id_card = :Id_card , level = :level , urole = :urole WHERE id = :id");
                $insert_stmt->bindParam(':id', $id);
                $insert_stmt->bindParam(':firstname', $firstname);
                $insert_stmt->bindParam(':lastname', $lastname);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':tel', $tel);
        
                $insert_stmt->bindParam(':line_Id', $line_Id);
                $insert_stmt->bindParam(':address', $address);
                $insert_stmt->bindParam(':m_img', $fileNew);
                $insert_stmt->bindParam(':urole', $urole);
                $insert_stmt->bindParam(':Id_card', $Id_card);
                $insert_stmt->bindParam(':level', $level);
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขข้อมูลตัวแทนจำหน่ายเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=dealer_general.php'>";
                    //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                    // header("refresh:2;product.php");
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {
        $insert_stmt = $conn->prepare("UPDATE dealer_general SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel , line_Id = :line_Id ,
        address = :address, m_img = :m_img , Id_card = :Id_card , level = :level , urole = :urole WHERE id = :id");
        $insert_stmt->bindParam(':id', $id);
        $insert_stmt->bindParam(':firstname', $firstname);
        $insert_stmt->bindParam(':lastname', $lastname);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->bindParam(':tel', $tel);
        $insert_stmt->bindParam(':line_Id', $line_Id);
        $insert_stmt->bindParam(':address', $address);
        $insert_stmt->bindParam(':m_img', $img_dealer_gen);
        $insert_stmt->bindParam(':urole', $urole);
        $insert_stmt->bindParam(':Id_card', $Id_card);
        $insert_stmt->bindParam(':level', $level);
        $insert_stmt->execute();

        if ($insert_stmt) {
            echo "<script>alert('แก้ไขข้อมูลตัวแทนจำหน่ายเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=dealer_general.php'>";
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
                        <h3>แก้ไขข้อมูลตัวแทนจำหน่าย (ทั่วไป)</h3>
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
                    <form id="dealer_general_edit_form" method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">

                        <?php
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $select_stmt = $conn->prepare("SELECT * FROM dealer_general WHERE id = :id");
                            $select_stmt->bindParam(":id", $id);
                            $select_stmt->execute();
                            $data_id_dealer_general = $select_stmt->fetchAll();
                        }
                        ?>
                        <div class="form-group text-center">
                            <div class="row gx-5">
                                <div class="col" style="display: inline-flex;" align="left">
                                    <div class="p-3"><label for="m_img" class="col-form-label" style="margin-bottom: 0px;">รูปภาพโปรไฟล์ <label class="col-form-label" style="color: red;">(กรุณาอัปโหลดรูปโปรไฟล์ทุกครั้ง)</label></label>
                                        <div class="filewrap">
                                            <input name="m_img" id="imgInput" value="" class="form-control" type="file" />
                                            <img width="100%" id="previewImg" src="../admin/dg_img/<?php echo  $data_id_dealer_general[0]['m_img']; ?>" alt="">
                                        </div>
                                    </div>


                                </div>

                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <input type="hidden" name="id" value="<?php echo $data_id_dealer_general[0]['id']; ?>">
                                    <div class="p-3"><label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                        <input type="text" value="<?php echo $data_id_dealer_general[0]['firstname']; ?>" class="form-control" name="firstname" aria-describedby="firstname">
                                    </div>
                                </div>
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                                        <input type="text" value="<?php echo $data_id_dealer_general[0]['lastname']; ?>" class="form-control" name="lastname" aria-describedby="lastname">
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                                        <input type="email" value="<?php echo $data_id_dealer_general[0]['email']; ?>" class="form-control" name="email" aria-describedby="email">
                                    </div>
                                </div>
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                                        <input type="text" value="<?php echo $data_id_dealer_general[0]['line_Id']; ?>" class="form-control" name="line_Id" aria-describedby="line_Id">
                                    </div>
                                </div>

                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                                        <input type="tel" value="<?php echo $data_id_dealer_general[0]['tel']; ?>" class="form-control" maxlength="10" name="tel" aria-describedby="tel">
                                    </div>
                                </div>
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่</label>
                                        <input type="text" value="<?php echo $data_id_dealer_general[0]['address']; ?>" class="form-control" name="address" id="address" aria-describedby="address">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="Id_card" class="form-label" style="margin-bottom: 0px;">รหัสประจำตัวประชาชน</label>
                                        <input type="text" value="<?php echo $data_id_dealer_general[0]['Id_card']; ?>" class="form-control" name="Id_card" id="Id_card" aria-describedby="Id_card">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="level" class="col-form-label">สถานะ</label>
                                        <select class="form-control" value="<?php echo $data_id_dealer_general[0]['level']; ?>" name="level" id="">
                                            <option value="<?php echo $data_id_dealer_general[0]['level']; ?>">
                                                <?php echo $data_id_dealer_general[0]['level']; ?>
                                            </option>
                                            <option value="">เลือกข้อมูล</option>
                                            <option value="Dealer">Dealer</option>
                                            <option value="Super VIP">Super VIP</option>
                                            <option value="VIP">VIP</option>
                                            <option value="Member 2">Member 2</option>
                                            <option value="Member 1">Member 1</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-md-12 mt-3">
                                <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                <a href="dealer_general.php" class="btn btn-danger">ยกเลิก</a>
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