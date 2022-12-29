<!DOCTYPE html>
<script src="https://cdn.tiny.cloud/1/jmppkn1dz7h7i7y2q55obyprypvx3csrnin8rqp3bjcki9i1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
include('menu_l.php');
require_once('../config/db.php');

if (isset($_REQUEST['update_id'])) {
    $id = $_REQUEST['update_id'];
    $select_stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
    $select_stmt->bindParam(':p_id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
}

if (isset($_POST['btn_update'])) {
    $p_id = $_POST['p_id'];
    $p_name = $_POST['name'];
    $p_detail = $_POST['detail'];
    $p_price = $_POST['price'];
    $p_amount = $_POST['amount'];
    $p_unit = $_POST['unit'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $img3 = $_FILES['img3'];
    $t_id = $_POST['t_name'];

    if ($t_id == "อาหารเสริม") {
        $data_tp = "2";
    } else if ($t_id == "ยาสามัญประจำบ้าน") {
        $data_tp = "1";
    } else if ($t_id == "ยาที่จ่ายผ่านคลินิก") {
        $data_tp = "3";
    } else if ($t_id == "ยาที่ขึ้นทะเบียนแล้ว") {
        $data_tp = "4";
    } else if ($t_id == "ยาแผนโบราณ") {
        $data_tp = "5";
    }

    $allow = array('jpg', 'jpeg', 'png');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention3 = explode(".", $img3['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt3 = strtolower(end($extention3)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . $fileActExt1;
    $fileNew2 = rand() . "." . $fileActExt2;
    $fileNew3 = rand() . "." . $fileActExt3;
    $filePath1 = "../admin/p_img/" . $fileNew1;
    $filePath2 = "../admin/p_img/" . $fileNew2;
    $filePath3 = "../admin/p_img/" . $fileNew3;

    if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                $insert_stmt = $conn->prepare("UPDATE product SET p_name = :p_name, p_detail = :p_detail, p_price = :p_price, p_amount = :p_amount, p_unit = :p_unit, p_img1 = :p_img1, p_img2 = :p_img2, p_img3 = :p_img3 , t_id = :t_id WHERE p_id = :p_id");
                $insert_stmt->bindParam(':p_id', $p_id);
                $insert_stmt->bindParam(':p_name', $p_name);
                $insert_stmt->bindParam(':p_detail', $p_detail);
                $insert_stmt->bindParam(':p_price', $p_price);
                $insert_stmt->bindParam(':p_amount', $p_amount);
                $insert_stmt->bindParam(':p_unit', $p_unit);
                $insert_stmt->bindParam(':p_img1', $fileNew1);
                $insert_stmt->bindParam(':p_img2', $fileNew2);
                $insert_stmt->bindParam(':p_img3', $fileNew3);
                $insert_stmt->bindParam(':t_id', $data_tp);
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขสินค้าเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=product.php'>";
                    //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                    // header("refresh:2;product.php");
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else  if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                $insert_stmt = $conn->prepare("UPDATE product SET p_name = :p_name, p_detail = :p_detail, p_price = :p_price, p_amount = :p_amount, p_unit = :p_unit, p_img1 = :p_img1, p_img2 = :p_img2 , t_id = :t_id WHERE p_id = :p_id");
                $insert_stmt->bindParam(':p_id', $p_id);
                $insert_stmt->bindParam(':p_name', $p_name);
                $insert_stmt->bindParam(':p_detail', $p_detail);
                $insert_stmt->bindParam(':p_price', $p_price);
                $insert_stmt->bindParam(':p_amount', $p_amount);
                $insert_stmt->bindParam(':p_unit', $p_unit);
                $insert_stmt->bindParam(':p_img1', $fileNew1);
                $insert_stmt->bindParam(':p_img2', $fileNew2);
                // $insert_stmt->bindParam(':p_img3', $fileNew3);
                $insert_stmt->bindParam(':t_id', $data_tp);
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขสินค้าเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=product.php'>";
                    //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                    // header("refresh:2;product.php");
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else  if (in_array($fileActExt1, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                $insert_stmt = $conn->prepare("UPDATE product SET p_name = :p_name, p_detail = :p_detail, p_price = :p_price, p_amount = :p_amount, p_unit = :p_unit, p_img1 = :p_img1 , t_id = :t_id WHERE p_id = :p_id");
                $insert_stmt->bindParam(':p_id', $p_id);
                $insert_stmt->bindParam(':p_name', $p_name);
                $insert_stmt->bindParam(':p_detail', $p_detail);
                $insert_stmt->bindParam(':p_price', $p_price);
                $insert_stmt->bindParam(':p_amount', $p_amount);
                $insert_stmt->bindParam(':p_unit', $p_unit);
                $insert_stmt->bindParam(':p_img1', $fileNew1);
                // $insert_stmt->bindParam(':p_img2', $fileNew2);
                // $insert_stmt->bindParam(':p_img3', $fileNew3);
                $insert_stmt->bindParam(':t_id', $data_tp);
                $insert_stmt->execute();

                if ($insert_stmt) {
                    echo "<script>alert('แก้ไขสินค้าเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=product.php'>";
                    //$updateMsg = "เพิ่มสินค้าเรียบร้อยแล้ว";

                    // header("refresh:2;product.php");
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {
        $insert_stmt = $conn->prepare("UPDATE product SET p_name = :p_name, p_detail = :p_detail, p_price = :p_price, p_amount = :p_amount, p_unit = :p_unit, p_img1 = :p_img1, p_img2 = :p_img2, p_img3 = :p_img3 , t_id = :t_id WHERE p_id = :p_id");
        $insert_stmt->bindParam(':p_id', $p_id);
        $insert_stmt->bindParam(':p_name', $p_name);
        $insert_stmt->bindParam(':p_detail', $p_detail);
        $insert_stmt->bindParam(':p_price', $p_price);
        $insert_stmt->bindParam(':p_amount', $p_amount);
        $insert_stmt->bindParam(':p_unit', $p_unit);
        $insert_stmt->bindParam(':p_img1', $row["p_img1"]);
        $insert_stmt->bindParam(':p_img2', $row["p_img2"]);
        $insert_stmt->bindParam(':p_img3', $row["p_img3"]);
        $insert_stmt->bindParam(':t_id', $data_tp);
        $insert_stmt->execute();

        if ($insert_stmt) {
            echo "<script>alert('แก้ไขสินค้าเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=product.php'>";
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

    .pos {
        display: flex;
    }
</style>


<?php

$select_stmt = $conn->prepare("SELECT * FROM p_type WHERE t_id = :t_id");
$select_stmt->bindParam(':t_id', $row['t_id']);
$select_stmt->execute();
$query =  $select_stmt->fetchAll();

?>



<body>
    <div class="right_col" role="main">
        <div class="row" style="display: inline-block;">

        </div>



        <div class="row">
            <div class="col-md-12 col-sm-12 " style="height: 1500px;">
                <div class="dashboard_graph">

                    <div class="col-md-6">
                        <h3>แก้ไขข้อมูลสินค้า</h3>
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
                    <form method="POST" class="form-horizontal mt-5" enctype="multipart/form-data">
                        <?php
                        if (isset($_GET['update_id'])) {
                            $p_id = $_GET['update_id'];
                            $stmt = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
                            $stmt->bindParam(":p_id", $p_id);
                            $stmt->execute();
                            $data_id_product = $stmt->fetchAll();
                            // echo '<pre>';
                            // print_r($row);
                            // echo '<pre>';
                        }
                        ?>
                        <div class="form-group text-center">
                            <div class="row gx-5">
                                <div class="col" align="center" style="display: inline-flex;">
                                    <div class="p-3"><label for="img" class="col-form-label" style="color: black;"></label>
                                        <br><img class="rounded" width="30%" src="../admin/p_img/<?php echo $row['p_img1']; ?>" alt="">

                                    </div>
                                </div>
                            </div>



                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <input type="hidden" name="p_id" value="<?php echo $data_id_product[0]['p_id']; ?>">
                                    <div class="p-3"> <label for="name" class="col-form-label">ชื่อสินค้า</label>

                                        <input type="text" name="name" class="form-control" value="<?php echo $row['p_name']; ?>">
                                    </div>
                                </div>
                                <div class="col" align="left">
                                    <div class="p-3 "><label for="price" class="col-form-label">ราคา(บาท)</label>
                                        <input type="text" name="price" class="form-control" value="<?php echo $row['p_price']; ?>">
                                    </div>
                                </div>
                            </div>
                            <script>
                                tinymce.init({
                                    selector: 'textarea',
                                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                    tinycomments_mode: 'embedded',
                                    tinycomments_author: 'Author name',
                                    mergetags_list: [{
                                            value: 'First.Name',
                                            title: 'First Name'
                                        },
                                        {
                                            value: 'Email',
                                            title: 'Email'
                                        },
                                    ]
                                });
                            </script>
                             <div class="col" align="left">
                                <label for="detail" class="col-form-label">รายละเอียด</label>
                                <textarea name="detail"><?php echo $row['p_detail']; ?></textarea>
                            <!-- <div class="row gx-5"> -->
                                <!-- <div class="col" align="left">
                                    <div class="p-3"> <label for="detail" class="col-form-label">รายละเอียด</label>
                                        <input type="text" name="detail" class="form-control" value="<?php echo $row['p_detail']; ?>">
                                    </div>
                                </div> -->
                               
                            <!-- </div> -->
                               
                            </div>

                            <div class="row gx-5">
                                <div class="col" align="left">
                                    <div class="p-3"> <label for="amount" class="col-form-label">จำนวนสินค้า</label>
                                        <input type="number" name="amount" class="form-control" value="<?php echo $row['p_amount']; ?>">
                                    </div>
                                </div>

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="unit" class="col-form-label">หน่วย </label>
                                        <input type="text" name="unit" class="form-control" value="<?= $row["p_unit"] ?>">
                                        <!-- <select class="form-control" name="unit" id="">
                                            <option value="<?= $row["p_unit"] ?>" selected disabled><?= $row["p_unit"] ?></option>
                                           
                                        </select> -->
                                    </div>
                                </div>
                            </div>


                            <div class="row gx-5">

                                <div class="col" align="left">
                                    <div class="p-3 "><label for="t_name" class="col-form-label">ประเภทสินค้า </label>
                                        <input type="text" name="t_name" class="form-control" value="<?= $query[0]["t_name"] ?>">
                                        <!-- <select class="form-control" name="t_name" id="">
                                            <option value="<?= $query[0]["t_name"] ?>" selected disabled><?= $query[0]["t_name"] ?></option>
                                           
                                        </select> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-5" align="left">
                                <div class="col" style="display: inline-flex;">
                                    <div class="pos p-3"><label for="img" class="col-form-label">รูปภาพ </label>
                                        <div class="filewrap">
                                            <input name="img1" id="imgInput1" class="form-control" type="file" />
                                            <img width="100%" id="previewImg1" alt="">
                                        </div>
                                        <div class="filewrap">
                                            <input name="img2" id="imgInput2" class="form-control" type="file" />
                                            <img width="100%" id="previewImg2" alt="">
                                        </div>
                                        <div class="filewrap">
                                            <input name="img3" id="imgInput3" class="form-control" type="file" />
                                            <img width="100%" id="previewImg3" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <div class="col-md-12 mt-3">
                                    <input type="submit" name="btn_update" class="btn btn-success" value="บันทึกข้อมูล"> &nbsp;&nbsp;
                                    <a href="product.php" class="btn btn-danger">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


        </div>
        <script>
            let imgInput1 = document.getElementById('imgInput1');
            let previewIm = document.getElementById('previewImg1');
            let imgInput2 = document.getElementById('imgInput2');
            let previewIm2 = document.getElementById('previewImg2');
            let imgInput3 = document.getElementById('imgInput3');
            let previewImg3 = document.getElementById('previewImg3');

            imgInput1.onchange = evt => {
                const [file] = imgInput1.files;
                if (file) {
                    previewImg1.src = URL.createObjectURL(file);
                }
            }
            imgInput2.onchange = evt => {
                const [file] = imgInput2.files;
                if (file) {
                    previewImg2.src = URL.createObjectURL(file);
                }
            }
            imgInput3.onchange = evt => {
                const [file] = imgInput3.files;
                if (file) {
                    previewImg3.src = URL.createObjectURL(file);
                }
            }
        </script>
    </div>

</body>