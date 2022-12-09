<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<?php
require_once('../config/db.php');
include('menu_l.php');
//error_reporting(0);

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
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
    $address =  $_POST['address'];
    $m_img =  $_FILES['m_img'];
    $line_Id = $_POST['line_Id'];
    $img_user = $row['m_img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extention = explode(".", $m_img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt = strtolower(end($extention)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "../admin/m_img/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($m_img['size'] > 0 && $m_img['error'] == 0) {
            if (move_uploaded_file($m_img['tmp_name'], $filePath)) {
                $insert_stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel  , line_Id = :line_Id ,
                                                                        address = :address, m_img = :m_img WHERE id = :id");
                $insert_stmt->bindParam(':id', $id);
                $insert_stmt->bindParam(':firstname', $firstname);
                $insert_stmt->bindParam(':lastname', $lastname);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':tel', $tel);
                $insert_stmt->bindParam(':line_Id', $line_Id);
                $insert_stmt->bindParam(':address', $address);
                $insert_stmt->bindParam(':m_img', $fileNew);

                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=admin.php'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {

        $insert_stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email , tel = :tel  , line_Id = :line_Id ,
                                                                    address = :address, m_img = :m_img WHERE id = :id");
        $insert_stmt->bindParam(':id', $id);
        $insert_stmt->bindParam(':firstname', $firstname);
        $insert_stmt->bindParam(':lastname', $lastname);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->bindParam(':tel', $tel);
        $insert_stmt->bindParam(':line_Id', $line_Id);
        $insert_stmt->bindParam(':address', $address);
        $insert_stmt->bindParam(':m_img', $img_user);
        $insert_stmt->execute();

        if ($insert_stmt) {
            echo "<script>alert('แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=admin.php'>";
            //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

            // header("refresh:2;product.php");
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        }
    }
}
?>
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

    .btn1 {
        background-color: #EFB50E;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;

    }

    .btn1:hover {
        color: white;

    }

    .a .bi .bi-pencil-square {
        width: 10px;
        height: 10px;
    }

    .btn2 {
        background-color: #E62B18;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        width: 5px;
        height: 20px;
        border-radius: 5px;
    }

    .btn2:hover {
        color: white;

    }
</style>


<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>



        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>แก้ไขข้อมูลผู้ใช้งานทั่วไป</h3>
                        <?php
                        ?>
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
                    <form id="admin_add_form" method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">

                        <?php
                        if (isset($_GET['update_id'])) {
                            $id = $_GET['update_id'];
                            $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                            $select_stmt->bindParam(":id", $id);
                            $select_stmt->execute();
                            $data_id_users = $select_stmt->fetchAll();
                        }
                        ?>
                        <div class="form-group text-center">
                            <div class="row gx-5">
                                <div class="col" align="center" style="display: inline-flex;">
                                    <div class="p-3"><label for="m_img" class="col-form-label" style="color: black;"></label>
                                        <br><img class="rounded" width="30%" src="../admin/m_img/<?php echo $row['m_img']; ?>" alt="">

                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="p-3"><label for="firstname" class="form-label" style="margin-bottom: 0px;">ชื่อ</label>
                                        <input type="text" value="<?php echo $row['firstname']; ?>" class="form-control" name="firstname" aria-describedby="firstname">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="lastname" class="form-label" style="margin-bottom: 0px;">นามสกุล</label>
                                        <input type="text" value="<?php echo $row['lastname']; ?>" class="form-control" name="lastname" aria-describedby="lastname">
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="email" class="form-label" style="margin-bottom: 0px;">อีเมล</label>
                                        <input type="email" value="<?php echo $row['email']; ?>" class="form-control" name="email" aria-describedby="email">
                                    </div>
                                </div>

                                <!-- <div class="col" align="left">
                                    <div class="p-3 "><label for="password" class="form-label" style="margin-bottom: 0px;">รหัสผ่าน</label>
                                        <input type="password"  class="form-control" name="password">
                                    </div>
                                </div> -->


                                <div class="col" align="left">
                                    <div class="p-3 "><label for="line_Id" class="form-label" style="margin-bottom: 0px;">ไลน์ไอดี</label>
                                        <input type="text" value="<?php echo $row['line_Id']; ?>" class="form-control" name="line_Id" aria-describedby="line_Id">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="tel" class="form-label" style="margin-bottom: 0px;">โทรศัพท์</label>
                                        <input type="tel" value="<?php echo $row['tel']; ?>" class="form-control" maxlength="10" name="tel" aria-describedby="tel">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="address" class="form-label" id="label-address" style="margin-bottom: 0px;">ที่อยู่</label>
                                        <input type="text" value="<?php echo $row['address']; ?>" class="form-control" name="address" id="address" aria-describedby="address">
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="urole" class="form-label" style="margin-bottom: 0px;">สถานะ</label>
                                        <input value=" <?= $row["urole"] ?>" readonly class="form-control" type="text" />
                                    </div>
                                </div>

                                <div class="col" style="display: inline-flex;" align="left">
                                    <div class="p-3 "><label for="m_img" class="col-form-label" style="margin-bottom: 0px;">รูปภาพ </label>
                                        <div class="filewrap">
                                            <input name="m_img" id="imgInput" class="form-control" type="file" />
                                            <img width="100%" id="previewImg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3">
                                    <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="admin.php" class="btn btn-danger">ยกเลิก</a>

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